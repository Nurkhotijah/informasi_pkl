<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kehadiran;

class KehadiranController extends Controller
{
    public function index()
{
    $kehadiran = Kehadiran::where('user_id', Auth::id())
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('pages-user.riwayat-absensi', compact('kehadiran'));
}

    public function store(Request $request)
{
    $request->validate([
        'foto_izin' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    $user = Auth::user();

    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->photo));
    $fileName = 'foto_kehadiran/' . uniqid() . '.png';

    Storage::disk('public')->put($fileName, $imageData);

    $kehadiran = Kehadiran::where('user_id', $user->id)
        ->whereDate('tanggal', now()->toDateString())
        ->first();

    if (!$kehadiran) {
        Kehadiran::create([
            'user_id' => $user->id,
            'tanggal' => now()->toDateString(),
            'waktu_masuk' => now()->toTimeString(),
            'foto_masuk' => $fileName,
            'status_kehadiran' => 'Hadir',
        ]);
    } else {
        $kehadiran->update([
            'waktu_keluar' => now()->toTimeString(),
            'foto_keluar' => $fileName,
        ]);
    }

    return response()->json(['message' => 'Kehadiran berhasil disimpan']);
}
}