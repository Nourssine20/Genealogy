<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Handle the registration of a new user.
     */
    public function register(Request $request)
    {
        // Validation des données d'entrée
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Vérification de l'unicité de l'email
            'password' => 'required|string|min:8|confirmed',  // Vérification de la confirmation du mot de passe
        ]);

        // Si la validation échoue, on retourne les erreurs
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Création de l'utilisateur avec gestion des exceptions pour l'unicité de l'email
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Vérification de l'erreur de duplication de l'email
            if ($e->getCode() === '23000') {
                // Utilisation d'une validation personnalisée pour l'email déjà utilisé
                return redirect()->back()->withErrors(['email' => 'Cet email est déjà utilisé.'])->withInput();
            }

            // Autres erreurs de base de données
            return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.')->withInput();
        }

        // Redirection après enregistrement réussi avec message de succès
        return redirect()->route('login')->with('success', 'Inscription réussie, vous pouvez maintenant vous connecter.');
    }
}
