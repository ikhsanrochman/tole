<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
{
    $request->validate([
        'email' => 'required|email|max:255',
        'whatsapp' => 'nullable|string|max:20',
        'password' => 'nullable|confirmed|min:6',
    ]);

    $admin = Auth::guard('admin')->user();

    $admin->email = $request->email;
    $admin->whatsapp = $request->whatsapp;

    if ($request->filled('password')) {
        $admin->password = md5($request->password); // Karena kamu pakai MD5
    }

    $admin->save();

    return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
}

}
