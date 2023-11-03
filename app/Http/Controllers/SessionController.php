<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{

    // Afficher le formulaire de création de crayon
    public function login(Request $request)
    {
        // Valider la requête
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Utiliser Auth::attempt pour vérifier les identifiants
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // Renvoyer en arrière avec une erreur si les identifiants sont incorrects
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Enregistrer un nouveau crayon dans la base de données
    public function register(Request $request)
    {
        // Règles de validation pour le mot de passe
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // doit être au moins de 8 caractères
                'regex:/[a-z]/',      // doit contenir au moins une lettre minuscule
                'regex:/[A-Z]/',      // doit contenir au moins une lettre majuscule
                'regex:/[0-9]/',      // doit contenir au moins un chiffre
                'regex:/[@$!%*#?&]/', // doit contenir au moins un caractère spécial
                'confirmed'           // doit être confirmé avec un champ password_confirmation
            ],
        ]);

        // Créer l'utilisateur
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), //  hacher le mot de passe
        ]);

        return redirect('/login')->with('success', 'Compte créé avec succès. Veuillez vous connecter.');
    }

    // Afficher le formulaire de modification de crayon
    public function logout()
    {
        try {
            session_start();
        }
        catch (\Exception){}
        $_SESSION['login'] = 'false';
        return redirect('/');
    }
}
