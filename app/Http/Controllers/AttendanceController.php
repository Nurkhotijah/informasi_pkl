<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        // Menyimpan data absensi
        $attendance = new Attendance();
        $attendance->user_id = Auth::id();
        $attendance->status = 'checked_in';
        $attendance->photo = $request->photo; // Menyimpan URL foto dari frontend
        $attendance->save();

        return response()->json(['message' => 'Absen berhasil'], 200);
    }

    public function update(Request $request, Attendance $attendance)
    {
        // Memperbarui status absensi
        if ($attendance->user_id !== Auth::id()) {
            return response()->json(['message' => 'Tidak memiliki izin'], 403);
        }

        $attendance->status = $request->status; // Misalnya status: 'checked_out'
        $attendance->photo = $request->photo;
        $attendance->save();

        return response()->json(['message' => 'Status absensi diperbarui'], 200);
    }
}
