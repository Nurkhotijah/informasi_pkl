<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    // Menampilkan data kehadiran untuk user tertentu
    public function index()
    {
        $kehadiran = Kehadiran::with('user')->get(); // Mengambil semua data kehadiran dengan relasi ke tabel users
        return view('pages-user.riwayat-absensi', compact('kehadiran')); // Menampilkan kehadiran di view
    }

    // Menampilkan form untuk menambah kehadiran
    public function create()
    {
        $users = User::all(); // Mengambil semua user untuk memilih user yang hadir
        return view('kehadiran.create', compact('users'));
    }

    // Menyimpan data kehadiran
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|string',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'foto_izin' => 'nullable|image',
            'foto_masuk' => 'nullable|image',
            'foto_keluar' => 'nullable|image',
        ]);

        // Menyimpan data kehadiran
        $kehadiran = new Kehadiran();
        $kehadiran->user_id = $request->user_id;
        $kehadiran->tanggal = $request->tanggal;
        $kehadiran->status_kehadiran = $request->status_kehadiran;
        $kehadiran->waktu_masuk = $request->waktu_masuk;
        $kehadiran->waktu_keluar = $request->waktu_keluar;

        // Menyimpan foto izin jika ada
        if ($request->hasFile('foto_izin')) {
            $kehadiran->foto_izin = $request->file('foto_izin')->store('foto_izin');
        }
        
        // Menyimpan foto absen masuk jika ada
        if ($request->hasFile('foto_masuk')) {
            $kehadiran->foto_masuk = $request->file('foto_masuk')->store('foto_masuk');
        }
        
        // Menyimpan foto absen keluar jika ada
        if ($request->hasFile('foto_keluar')) {
            $kehadiran->foto_keluar = $request->file('foto_keluar')->store('foto_keluar');
        }

        $kehadiran->save(); // Menyimpan ke database

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    // Menampilkan detail kehadiran
    public function show($id)
    {
        $kehadiran = Kehadiran::with('user')->findOrFail($id); // Mengambil data kehadiran berdasarkan id
        return view('kehadiran.show', compact('kehadiran'));
    }

    // Menampilkan form untuk edit data kehadiran
    public function edit($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $users = User::all();
        return view('kehadiran.edit', compact('kehadiran', 'users'));
    }

    // Memperbarui data kehadiran
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|string',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'foto_izin' => 'nullable|image',
            'foto_masuk' => 'nullable|image',
            'foto_keluar' => 'nullable|image',
        ]);

        $kehadiran = Kehadiran::findOrFail($id);
        $kehadiran->user_id = $request->user_id;
        $kehadiran->tanggal = $request->tanggal;
        $kehadiran->status_kehadiran = $request->status_kehadiran;
        $kehadiran->waktu_masuk = $request->waktu_masuk;
        $kehadiran->waktu_keluar = $request->waktu_keluar;

        // Update foto jika ada perubahan
        if ($request->hasFile('foto_izin')) {
            $kehadiran->foto_izin = $request->file('foto_izin')->store('foto_izin');
        }
        
        if ($request->hasFile('foto_masuk')) {
            $kehadiran->foto_masuk = $request->file('foto_masuk')->store('foto_masuk');
        }
        
        if ($request->hasFile('foto_keluar')) {
            $kehadiran->foto_keluar = $request->file('foto_keluar')->store('foto_keluar');
        }

        $kehadiran->save();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    // Menghapus data kehadiran
    public function destroy($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus.');
    }
}
