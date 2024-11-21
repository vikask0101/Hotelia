<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Enum\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginPage(): View
    {
        return view('backend.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }

        if (Auth::user()->user_type !== UserTypeEnum::ADMIN->value) {
            Auth::logout();
            return back()->withErrors(['email' => 'You are not authorized to access this dashboard']);
        }
        return redirect()->route('admin.dashboard');
    }
}
