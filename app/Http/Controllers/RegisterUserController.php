<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view("Auth/Register");
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "nom_utilisateur" => "required|unique:users,nom_utilisateur",
                "role" => "required|in:direction,agent",
                "mot_de_passe" => "required|min:5|confirmed",
            ]);

            $user = new User();
            $user->nom_utilisateur = $validatedData['nom_utilisateur'];
            $user->mot_de_passe = Hash::make($validatedData['mot_de_passe']);
            $user->role = $validatedData['role'] == "direction" ? 1 : 2;

            $user->save();


            return redirect()->route("login")->with("success", "Compte créé avec succès. Veuillez vous connecter.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.'])->withInput();
        }
    }
}
