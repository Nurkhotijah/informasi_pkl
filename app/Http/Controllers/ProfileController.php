<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showprofilesekolah()
    {
        // Ambil data sekolah dari tabel users
        $profilesekolah = User::where('role', 'sekolah')->first();

        return view('pages-admin.profile-admin', compact('profilesekolah'));
    }
    public function edit()
{
    // Fetch the profile of the logged-in user by ID
    $profile = User::findOrFail(auth()->id());

    // Pass the profile data to the view for pre-filling the form
    return view('pages-admin.profile-update', compact('profile'));
}


public function update(Request $request)
{
    // Validate the input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Fetch the logged-in user's profile
    $profile = User::findOrFail(auth()->id());

    // Update the profile fields
    $profile->name = $request->name;
    $profile->alamat = $request->alamat;
    $profile->email = $request->email;

    // Update password if provided
    if ($request->has('password')) {
        $profile->password = Hash::make($request->password);
    }

    // Save the updated profile
    $profile->save();

    return redirect()->route('profile-admin')->with('success', 'Profil berhasil diperbarui.');
}

    
    // // Metode untuk mengganti kata sandi
    // public function updatePassword(Request $request)
    // {
    //     // Logika untuk mengganti kata sandi di sini
    //     return redirect()->back()->with('success', 'Kata sandi berhasil diganti.');
    // }
}
