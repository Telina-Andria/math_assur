<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contrat;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SinistreController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Sinistre::class, "sinistre");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sinistres = Sinistre::all();

        return view("Dashboard/sinistre", [
            "sinistres" => $sinistres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Contrat $contrat)
    {
        return view("form/newSinistre", [
            "contrat" => $contrat,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Contrat $contrat)
    {
        $validatedData = $request->validate([
            'numero_sinistre' => 'required|unique:sinistres',
            'montant_indemnise' => 'required|numeric|min:0',
            'description' => 'required'
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;
        $validatedData["by_contrat_id"] = $contrat->id;

        Sinistre::create($validatedData);

        return redirect()->route('sinistre.index')->with('success', 'Sinistre créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sinistre $sinistre)
    {
        return view("show/showSinistre", [
            "sinistre" => $sinistre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sinistre $sinistre)
    {
        return view('form/editSinistre', [
            "sinistre" => $sinistre
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sinistre $sinistre)
    {
        $validatedData = $request->validate([
            'montant_indemnise' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;

        $sinistre->update($validatedData);

        return redirect()->route('sinistre.show', $sinistre)->with('success', 'Le sinistre a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sinistre $sinistre)
    {
        $sinistre->delete();

        return redirect('/sinistre')->with('success', 'Sinistre deleted');
    }
}
