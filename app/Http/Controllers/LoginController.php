<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class LoginController extends Controller
{
    public function create()
    {
        return view("Auth/Login");
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            "nom_utilisateur" => "required|string",
            "mot_de_passe" => "required|min:5"
        ]);

        $user = User::where('nom_utilisateur', $credentials['nom_utilisateur'])->first();

        if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended("/dashboard")->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'nom_utilisateur' => 'Les informations de connexion fournies ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('nom_utilisateur'));
    }

    public function delete(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
