<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Client::class, "client");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view("Dashboard/client", [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("form/newClient");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'adresse' => 'required',
            'date_naissance' => 'required|date',
            'type_client' => 'required|in:individuel,groupe',
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;

        $client = Client::create($validatedData);

        return redirect()->route('client.index')->with('success', 'Client ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view("show/showClient", [
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view("form/editClient", [
            "client" => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'date_naissance' => 'required|date',
            'type_client' => 'required|in:individuel,groupe',
        ]);

        $validatedData["by_utilisateur_id"] = Auth::user()->id;

        $client->update($validatedData);

        return redirect()->route('client.show', $client)->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->back()->with('success', 'Client deleted');
    }
}
