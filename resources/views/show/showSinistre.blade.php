@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Détails du Sinistre</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('sinistre.edit', $sinistre) }}" class="btn btn-sm btn-outline-primary ml-2">
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
                        Informations du Sinistre
                    </div>
                    <div class="card-body">
                        <p><strong>Numéro de sinistre :</strong> {{ $sinistre->numero_sinistre }}</p>
                        <p><strong>Date de déclaration :</strong> {{ $sinistre->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Montant indemnisé :</strong> {{ number_format($sinistre->montant_indemnise, 2) }} Ar</p>
                        <p><strong>Statut :</strong> {{ ucfirst($sinistre->statut) }}</p>
                        <p><strong>Description :</strong> {{ $sinistre->description ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Informations associées
                    </div>
                    <div class="card-body">
                        <h5>Contrat concerné</h5>
                        <p><strong>Numéro de contrat :</strong> {{ $sinistre->contrat->numero_contrat }}</p>
                        <p><strong>Type de contrat :</strong> {{ ucfirst($sinistre->contrat->type_contrat) }}</p>
                        <a href="{{ route('contrat.show', $sinistre->contrat) }}" class="btn btn-sm btn-info">Voir le
                            contrat</a>

                        <hr>

                        <h5>Client</h5>
                        <p><strong>Nom :</strong> {{ $sinistre->contrat->client->nom }}</p>
                        <p><strong>Prénom :</strong> {{ $sinistre->contrat->client->prenom }}</p>
                        <a href="{{ route('client.show', $sinistre->contrat->client) }}" class="btn btn-sm btn-info">Voir
                            le profil du client</a>

                        <hr>

                        <h5>Utilisateur responsable</h5>
                        <p><strong>Nom d'utilisateur :</strong> {{ $sinistre->utilisateur->nom_utilisateur }}</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <form action="{{ route('sinistre.destroy', $sinistre) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sinistre ?')">
                    <i class="fas fa-trash"></i> Supprimer le sinistre
                </button>
            </form>
        </div>
    </main>
@endsection
