<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Pengajuan;
use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndustriController extends Controller
{
     public function dashboard()
    {
        return view('pages-industri.dashboard-industri');
    }
    
    public function UpdateIndustri()
    {
        // Logika untuk menampilkan 
        return view('pages-industri.update-industri');
    }
   
    public function Kehadiran()
    {
        // Ambil data kehadiran dari database
        $kehadiran = Kehadiran::all(); // Sesuaikan dengan query yang sesuai dengan kebutuhan
        return view('pages-industri.kelola-kehadiran', compact('kehadiran'));
    }
    public function edit($id)
    {
        $item = Kehadiran::with('user')->find($id);
        $item = Kehadiran::findOrFail($id);
        return view('pages-industri.edit-kehadiran', compact('item'));
    }

    public function updatekehadiran(Request $request, $id)
{
    
    // Validasi input
    $request->validate([
        'status' => 'required|string',
    ]);

    // Mencari data kehadiran berdasarkan ID
    $item = Kehadiran::findOrFail($id);
    
    // Update status kehadiran
    $item->status = $request->status;
    $item->save(); // Simpan perubahan

    // Redirect kembali dengan pesan sukses
    return redirect()->route('kelola-kehadiran')->with('success', 'Kehadiran berhasil diperbarui.');
}

    public function dataSekolah()
    {
        $listSekolah = User::where('role', 'sekolah')->get();

        return view('pages-industri.data-sekolah', compact('listSekolah'));
    }

    public function lihatSiswa($id)
    {
        $listSiswa = Pengajuan::where('id_sekolah', $id)->get();

        return view('pages-industri.lihat-siswa', compact('listSiswa'));
    }

    public function updateStatusSiswa(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $id = $validated['id'];
        $status = $validated['status'];

        $pengajuanSiswa = Pengajuan::where('id', $id)->first();

        Pengajuan::where('id', $id)->update(['status' => $status]);

        User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => preg_replace('/\s+/', '-', $pengajuanSiswa->nama_siswa) . '@gmail.com',
            'alamat' => null,
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        // Kembalikan response sukses
        return response()->json([
            'success' => 200,
            'message' => "Status siswa telah diperbarui menjadi {$status}.",
        ]);
    }

    // Fungsi untuk membuat akun siswa setelah pengajuan disetujui
    protected function createSiswaAccount(Pengajuan $pengajuanSiswa)
    {
        // Membuat akun siswa baru
        $user = User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => $pengajuanSiswa->nama_siswa . '@gmail.com', // Contoh: email berdasarkan nama siswa
            'password' => bcrypt('siswa123'), // Password default atau bisa diset sesuai kebutuhan
            'role' => 'siswa', // Menandakan bahwa role-nya adalah siswa
            'id_sekolah' => $pengajuanSiswa->id_sekolah, // Menyimpan ID sekolah dari siswa
        ]);
    }

    public function index()
    {
        $jurnal = User::whereHas('profile', function ($query) {
            $query->where('id_sekolah', '!=', null);
        })
        ->where('role', 'siswa')
        ->with('laporan')  // Eager loading untuk relasi 'laporan' yang hanya 1
        ->get();
    
        // Mengirim data jurnal dan laporan ke tampilan
        return view('pages-industri.jurnal.index', compact('jurnal'));
    }
    
    


    
    

public function update(Request $request, $id)
{
    // Update status kehadiran berdasarkan ID
    $kehadiran = Kehadiran::findOrFail($id);
    
    // Validasi status, jika diperlukan
    $kehadiran->status = $request->status;
    $kehadiran->save();

    return redirect()->route('kelola-kehadiran')->with('success', 'Status kehadiran berhasil diperbarui');
}


    public function kelolaNilai()
    {

        return view('pages-industri.kelola-nilai');
    }

    public function kehadiranSiswa()
    {

        return view('pages-industri.kehadiran-siswa');
    }

    public function profileindustri()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.profile-industri');
    }

    public function editPengajuan()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.edit-pengajuan');
    }

    //REKAP KEHADIRAN SISWA


    public function lihatKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.lihat-rekap');
    }

    public function HapusKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.hapus-rekap');
    }

    public function editKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.edit-rekap');
    }

    public function tambahKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.tambah-rekap');
    }

    public function cetakKehadiran()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-industri.cetak-rekap');
    }

    //KELOLA NILAI

    // public function editNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.edit-nilai'); 
    // }

    // public function tambahNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.tambah-nilai'); 
    // }

    // public function cetakNilai()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-industri.cetak-nilai'); 
    // }
}
