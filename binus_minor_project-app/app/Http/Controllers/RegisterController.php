<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 1. Afficher le formulaire d'inscription
    public function showRegistrationForm()
    {
        // On va chercher le fichier dans resources/views/auth/register.blade.php
        return view('register'); 
    }

    // 2. Traiter l'inscription
    public function register(Request $request)
    {
        // Validation stricte des données reçues
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // attend un champ password_confirmation
        ]);

        // Création de l'utilisateur dans MySQL
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // On connecte automatiquement l'utilisateur tout de suite après sa création
        Auth::login($user);

        // Retour à l'accueil avec un message de succès
        return redirect('/')->with('success', 'Votre compte a été créé avec succès ! Bienvenue !');
    }
}