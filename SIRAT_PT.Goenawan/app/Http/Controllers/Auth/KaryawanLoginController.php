<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class KaryawanLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.karyawan-login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('karyawan')->attempt($this->credentials($request))) {
            return redirect()->intended(route('karyawan.dashboard'));
        }

        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    public function logout(Request $request)
    {
        Auth::guard('karyawan')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('karyawan.login');
    }
}
