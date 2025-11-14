<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomResetPasswordController extends Controller
{
    /**
     * Show the form for requesting password reset link.
     */
    public function showResetForm()
    {
        return view('auth.passwords.reset-username');
    }

    /**
     * Handle password reset request using username.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username harus diisi',
            'username.exists' => 'Username tidak ditemukan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}
