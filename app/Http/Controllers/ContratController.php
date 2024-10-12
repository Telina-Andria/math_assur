<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\HistoriqueContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contrat::class, "contrat");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrats = Contrat::all();
        return view("dashboard/contrat", [
            'contrats' => $contrats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $client_id)
    {
        return view('form/newContrat', [
            "client_id" => $client_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $client_id)
    {
        $validatedData = $request->validate([
            'numero_contrat' => 'required|unique:contrats',
            'type_contrat' => 'required|in:vie,non vie',
            'montant_assure' => 'required|numeric|min:0',
            'duree_contrat' => 'required|integer|min:1',
            'date_fin' => 'required|date',
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;
        $validatedData["by_client_id"] = $client_id;

        Contrat::create($validatedData);

        return redirect()->route('contrat.index')->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $contrat)
    {
        return view('show/showContrat', [
            'contrat' => $contrat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $contrat)
    {
        return view('form/editContrat', [
            'contrat' => $contrat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrat $contrat)
    {
        $validatedData = $request->validate([
            'type_contrat' => 'required|in:vie,non vie',
            'montant_assure' => 'required|numeric|min:0',
            'duree_contrat' => 'required|integer|min:1',
            'date_fin' => 'required|date',
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;

        $changes = [];
        foreach ($validatedData as $key => $value) {
            if ($contrat->$key != $value) {
                $changes[$key] = [
                    'old' => $contrat->$key,
                    'new' => $value
                ];
            }
        }

        $contrat->update($validatedData);

        if (!empty($changes)) {
            HistoriqueContrat::create([
                'by_contrat_id' => $contrat->id,
                'utilisateur_responsable' => Auth::user()->nom_utilisateur,
                'details' => json_encode($changes)
            ]);
        }

        return redirect()->route('contrat.show', $contrat)->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()->route('contrat.index')->with('success', 'Contrat supprimé avec succès.');
    }
}
