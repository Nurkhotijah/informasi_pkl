<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kehadiran;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    public function index()
    {
        // Mendapatkan data kehadiran berdasarkan user yang sedang login
        $kehadiran = Kehadiran::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung jumlah kehadiran user
        $jumlahKehadiran = Kehadiran::where('user_id', Auth::id())
            ->where('status', 'Hadir')
            ->count();

        // Cek status absen hari ini untuk menentukan jenis button yang ditampilkan
        $today = Carbon::now()->toDateString();
        $absenHariIni = Kehadiran::where('user_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        $jenisButton = 'masuk'; // Default button masuk

        if ($absenHariIni) {
            if ($absenHariIni->foto_masuk && !$absenHariIni->foto_keluar) {
                $jenisButton = 'pulang';
            } elseif ($absenHariIni->foto_masuk && $absenHariIni->foto_keluar) {
                $jenisButton = 'selesai';
            }
        }

        // Tambahkan URL foto untuk setiap kehadiran
        foreach ($kehadiran as $absen) {
            $absen->foto_masuk_url = $absen->foto_masuk ? Storage::url($absen->foto_masuk) : null;
            $absen->foto_keluar_url = $absen->foto_keluar ? Storage::url($absen->foto_keluar) : null;
            $absen->foto_izin_url = $absen->foto_izin ? Storage::url($absen->foto_izin) : null;
        }

        return view('pages-user.riwayat-absensi', compact('kehadiran', 'jenisButton', 'jumlahKehadiran'));
    }

    public function store(Request $request)
    {
        // Validasi input foto absen
        $request->validate([
            'foto_absen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_absen' => 'required|in:masuk,pulang', // Validasi jenis absen (masuk/pulang)
            'foto_izin' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $tanggalHariIni = Carbon::now()->toDateString();

        // Periksa apakah sudah ada data kehadiran untuk hari ini
        $kehadiran = Kehadiran::where('user_id', $user->id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->first();

        if ($request->hasFile('foto_izin')) {
            // Mengunggah foto izin jika ada
            $fotoIzin = $request->file('foto_izin');
            $fotoIzinPath = $fotoIzin->store('foto_izin', 'public');
        }

        // Proses foto absen
        $fotoAbsen = $request->file('foto_absen');
        $fotoPath = $fotoAbsen->store('absen_siswa', 'public');

        if (!$kehadiran) {
            // Jika tidak ada data kehadiran untuk hari ini, buat entri baru
            $kehadiran = Kehadiran::create([
                'user_id' => $user->id,
                'tanggal' => $tanggalHariIni,
                'status_kehadiran' => $request->hasFile('foto_izin') ? 'Izin' : 'Proses',
                'foto_izin' => $request->hasFile('foto_izin') ? $fotoIzinPath : null,
                'foto_masuk' => $request->jenis_absen == 'masuk' ? $fotoPath : null,
                'foto_keluar' => $request->jenis_absen == 'pulang' ? $fotoPath : null,
                'waktu_masuk' => $request->jenis_absen == 'masuk' ? Carbon::now() : null,
                'waktu_keluar' => $request->jenis_absen == 'pulang' ? Carbon::now() : null,
            ]);
        } else {
            // Update data kehadiran yang sudah ada
            if ($request->hasFile('foto_izin')) {
                $kehadiran->update([
                    'status_kehadiran' => 'Izin',
                    'foto_izin' => $fotoIzinPath,
                ]);
            } else {
                $updateData = [];
                
                if ($request->jenis_absen == 'masuk') {
                    $updateData['foto_masuk'] = $fotoPath;
                    $updateData['waktu_masuk'] = Carbon::now();
                } else {
                    $updateData['foto_keluar'] = $fotoPath;
                    $updateData['waktu_keluar'] = Carbon::now();
                }

                // Update status kehadiran
                if ($kehadiran->foto_masuk && $request->jenis_absen == 'pulang') {
                    $updateData['status_kehadiran'] = 'Hadir';
                } elseif (!$kehadiran->foto_izin) {
                    $updateData['status_kehadiran'] = 'Proses';
                }

                $kehadiran->update($updateData);
            }
        }

        // Hitung ulang jumlah kehadiran setelah update
        $jumlahKehadiran = Kehadiran::where('user_id', $user->id)
            ->where('status_kehadiran', 'Hadir')
            ->count();

        return response()->json([
            'message' => 'Data kehadiran berhasil disimpan',
            'jenis_button' => $request->jenis_absen == 'masuk' ? 'pulang' : 'selesai',
            'jumlah_kehadiran' => $jumlahKehadiran
        ]);
    }
}
