<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function account()
    {
        if (Auth::check()) {
            // L'utilisateur est connecté, affichez la page de compte
            return view('UserAccount', ['user' => Auth::user()]);
        } else {
            // L'utilisateur n'est pas connecté, redirigez vers la page de connexion
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour accéder à votre compte.');
        }
    }
}
