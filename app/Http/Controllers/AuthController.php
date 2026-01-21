<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin (): View {
        return view('Auth.login');
    }

    public function showRegis (): View {
        return view('Auth.register');
    }
}
