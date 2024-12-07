<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi foto dan data absen
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan data foto dan absensi
        $photo = $request->file('photo');
        $photoPath = $photo->store('public/absensi_photos');
        
        Absensi::create([
            'user_id' => auth()->id(),
            'check_in' => now(),  // waktu masuk
            'check_in_image' => $photoPath,
        ]);

        return response()->json(['message' => 'Absen berhasil']);
    }

    public function updateCheckOut(Request $request, $id)
    {
        $absensi = Absensi::find($id);
        $absensi->check_out = now();
        
        // Validasi foto keluar
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photo = $request->file('photo');
        $photoPath = $photo->store('public/absensi_photos');
        
        $absensi->check_out_image = $photoPath;
        $absensi->save();

        return response()->json(['message' => 'Absen pulang berhasil']);
    }
}

