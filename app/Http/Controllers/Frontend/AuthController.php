<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    /**
     * Inscription d'un utilisateur
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'firstname' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'firstname' => $request->input('firstname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return view('frontend.auth.login');
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Récupère les informations de l'utilisateur connecté
     */
    public function seeInfo()
    {
        $user = auth()->user();
        return view('frontend.auth.afterlogin', ['user' => $user]);
    }

    /**
     * Connexion d'un utilisateur et génération du jeton d'accès
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            $token = $user->createToken('MyApp')->accessToken;
            return view('frontend.auth.afterlogin', ['user' => $user]);
        }

        return redirect()->route('frontend.login')->withErrors(['error' => 'Identifiants invalides']);
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Déconnexion d'un utilisateur et révocation du jeton d'accès
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('success', 'Déconnexion réussie');
    }
    
}
