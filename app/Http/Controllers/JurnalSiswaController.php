<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\JurnalKegiatan;

class JurnalSiswaController extends Controller
{
    public function index()
    {
        $users = Auth::user();

        $jurnal = Jurnal::where('user_id', $users->id)->get();
        $laporan = Laporan::where('user_id', $users->id)->get(); 
        return view('pages-user.jurnal.index', compact('jurnal', 'laporan'));
    }

    public function create()
    {
        return view('pages-user.jurnal.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kegiatan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'laporan_id' => 'required|exists:laporan,id',            
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        // Mendapatkan data pengguna yang login
        $users = Auth::user();

        // Menyimpan file laporan PKL jika ada
        $laporanPath = $request->file('laporan_pkl') ? $request->file('laporan_pkl')->store('laporan', 'public') : null;
        // Menyimpan file foto kegiatan jika ada
        $fotoPath = $request->file('foto_kegiatan') ? $request->file('foto_kegiatan')->store('kegiatan', 'public') : null;

        // Menyimpan data jurnal kegiatan ke dalam database
        Jurnal::create([
            
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'laporan_id' => $request->laporan_id, // Simpan laporan_id            
            'foto_kegiatan' => $fotoPath,
            'user_id' => $users->id,  // ID pengguna yang login (siswa)
        ]);

        // Redirect ke halaman jurnal kegiatan dengan pesan sukses
        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal kegiatan berhasil ditambahkan!');
    }
    public function show($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        return view('pages-user.jurnal.index', compact('jurnal'));
    }

    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $users = Auth::user();
        $laporan = Laporan::where('user_id', $users->id)->get(); // Ambil laporan pengguna
        return view('pages-user.jurnal.edit', compact('jurnal', 'laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'laporan_id' => 'required|exists:laporan,id',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $jurnal = Jurnal::findOrFail($id);

        // Update file jika ada
        if ($request->hasFile('laporan_pkl')) {
            if ($jurnal->laporan_pkl) {
                Storage::disk('public')->delete($jurnal->laporan_pkl);
            }
            $jurnal->laporan_pkl = $request->file('laporan_pkl')->store('laporan', 'public');
        }

        if ($request->hasFile('foto_kegiatan')) {
            if ($jurnal->foto_kegiatan) {
                Storage::disk('public')->delete($jurnal->foto_kegiatan);
            }
            $jurnal->foto_kegiatan = $request->file('foto_kegiatan')->store('kegiatan', 'public');
        }

        $jurnal->update([
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'laporan_id' => $request->laporan_id,
        ]);

        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);

        // Hapus file laporan jika ada
        if ($jurnal->laporan_pkl) {
            Storage::disk('public')->delete($jurnal->laporan_pkl);
        }

        // Hapus file foto jika ada
        if ($jurnal->foto_kegiatan) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
        }

        $jurnal->delete();

        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal kegiatan berhasil dihapus!');
    }

    public function uploadLaporan(Request $request, $id)
    {
        $request->validate([
            'laporan_pkl' => 'required|file|mimes:pdf|max:5000',
        ]);

        $jurnal = Jurnal::findOrFail($id);

        // Hapus file lama jika ada
        if ($jurnal->laporan_pkl) {
            Storage::disk('public')->delete($jurnal->laporan_pkl);
        }

        // Simpan file baru
        $laporanPath = $request->file('laporan_pkl')->store('laporan', 'public');

        $jurnal->update([
            'laporan_pkl' => $laporanPath,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diunggah!');
    }
}
