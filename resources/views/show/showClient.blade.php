@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Détails du Client</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('client.edit', $client->id) }}" class="btn btn-sm btn-outline-primary ml-2">
                    <i class="fas fa-edit"></i> Modifier
                </a>
            </div>
        </div>

        <div class="row">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Informations du Client
                    </div>
                    <div class="card-body">
                        <p><strong>Nom :</strong> {{ $client->nom }}</p>
                        <p><strong>Prénom :</strong> {{ $client->prenom }}</p>
                        <p><strong>Adresse :</strong> {{ $client->adresse }}</p>
                        <p><strong>Date de naissance :</strong> {{ $client->date_naissance }}</p>
                        <p><strong>Type de client :</strong> {{ ucfirst($client->type_client) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Informations associées
                    </div>
                    <div class="card-body">
                        <h5>Utilisateur responsable</h5>
                        <p><strong>Nom d'utilisateur :</strong> {{ $client->utilisateur->nom_utilisateur }}</p>


                        <hr>

                        <h5>Contrats associés</h5>
                        @if ($client->contrat->count() > 0)
                            <ul>
                                @foreach ($client->contrat as $contrat)
                                    <li>
                                        <a href="{{ route('contrat.show', $contrat) }}">
                                            {{ $contrat->numero_contrat }} ({{ ucfirst($contrat->type_contrat) }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucun contrat associé</p>
                        @endif
                        <a href="{{ route('contrat.create', ['client_id' => $client->id]) }}"
                            class="btn btn-sm btn-success">Ajouter un contrat</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
