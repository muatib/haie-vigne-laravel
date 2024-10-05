<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Stockez les informations de l'utilisateur dans la session
        session([
            'user_firstname' => $user->firstname,
            'user_lastname' => $user->lastname,
            'user_email' => $user->email,
        ]);

        return redirect()->route('login')->with('success', 'Compte créé ! Vous pouvez vous connecter.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Si l'utilisateur se connecte avec succès, stockez également ses informations dans la session
            $user = Auth::user();
            session([
                'user_firstname' => $user->firstname,
                'user_lastname' => $user->lastname,
                'user_email' => $user->email,
            ]);

            return redirect()->route('index');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Effacez les informations de l'utilisateur de la session lors de la déconnexion
        session()->forget(['user_firstname', 'user_lastname', 'user_email']);

        return redirect('/');
    }
}
