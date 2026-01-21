<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin(): View | RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('Auth.login');
    }

    /**
     * Show register form
     */
    public function showRegis(): View | RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('Auth.register');
    }

    /**
     * Handle login request
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Login berhasil');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput(['email']);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login')
            ->with('success', 'Logout berhasil');
    }

    /**
     * Handle register request
     * Compatible with Metronic register form (tanpa field name)
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        try {
            User::create([
                // name tidak ada di form → generate otomatis dari email
                'name'     => Str::before($validated['email'], '@'),
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()
                ->route('auth.login')
                ->with('success', 'Registrasi berhasil, silakan login');
        } catch (\Throwable $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat registrasi'])
                ->withInput();
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword(): View
    {
        return view('Auth.forgot-password');
    }

    /**
     * Send reset password link
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        return back()->with('success', 'Link reset password telah dikirim ke email Anda');
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(string $token): View
    {
        $email = request('email');

        return view('Auth.reset-password', compact('token', 'email'));
    }

    /**
     * Handle reset password
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (! $passwordReset) {
            return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa']);
        }

        if (Carbon::parse($passwordReset->created_at)->addHours(24)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Token sudah kadaluarsa']);
        }

        if (! Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['token' => 'Token tidak valid']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()
            ->route('auth.login')
            ->with('success', 'Password berhasil direset, silakan login');
    }

    /**
     * Delete user account
     */
    public function deleteAccount(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (! Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai']);
        }

        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda telah dihapus');
    }

    /**
     * Show delete account confirmation form
     */
    public function showDeleteAccount(): View | RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('auth.login');
        }

        return view('Auth.delete-account');
    }
}
