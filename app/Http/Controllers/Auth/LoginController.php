<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect users to their respective dashboards after login
    protected function redirectTo()
    {
        // Check the user's role
        if (Auth::user()->isAdmin()) {
            return route('admin.dashboard');
        } else {
            return route('user.dashboard');
        }
    }

    // Other methods in the controller...
}
