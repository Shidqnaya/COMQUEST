<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
class AuthController extends Controller
{
    public function registerpage(){
        return view ('auth.register');
    }
    public function loginpage(){
        return view ('auth.login');
    }


    public function login(Request $request): RedirectResponse
    {
        $creds = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required'
        ]);

        if (Auth::attempt($creds)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'auth' => 'Invalid Credentials',
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username is required',
            'name.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'gender.required' => 'Gender is required',
            'password.required' => 'Password is required',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('loginpage')->with('success', 'Registration successful. Please login.');
    }

    public function redirect()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }



    public function logout(Request $request)
    {
        Auth::logout(); // Keluar dari sesi pengguna

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page or homepage
        return redirect('auth')->with('success', 'Logout berhasil!');
    }
}
