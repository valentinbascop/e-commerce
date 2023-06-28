<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class LoginController extends Controller
{
    /**
     * Show the registration form for administrators.
     */
    public function showRegistrationForm()
    {
        return view('backend.auth.register');
    }

    /**
     * Register a new administrator.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:administrators',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Administrator::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('backend.login')->with('success', 'Registration successful. You can now log in.');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/products');
        }

        return redirect()->back()->withErrors(['error' => 'Identifiants invalides'])->withInput();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
    }
    
}
