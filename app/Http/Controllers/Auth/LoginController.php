<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect users after authentication based on role
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            // Redirect admin users to Backpack admin panel
            return redirect('/admin');
        }

        // Redirect regular users to their dashboard
        return redirect('/dashboard');
    }
}
