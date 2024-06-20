<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;



class AuthController extends Controller
{

    public function __construct()
    {
        //
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->safe()->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $credentials['email'];
        $password = $credentials['password'];

        $user = User::where('email', $email)->first(); 

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
