@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Détails du Sinistre</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                @if (Auth::user()->can('update', $sinistre) && $sinistre->status == 'en cours')
                    <a href="{{ route('sinistre.edit', $sinistre) }}" class="btn btn-sm btn-outline-primary ml-2">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                @endif
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
                        <p><strong>Montant indemnisé :</strong> {{ number_format($sinistre->montant_indemnise, 2) }} Ar
                        </p>
                        <p><strong>Statut :</strong> {{ ucfirst($sinistre->status) }}</p>
                        <p><strong>Validateur :</strong>
                            {{ ucfirst($sinistre->validateur?->nom_utilisateur ?? 'En cours') }}
                        </p>
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

                        <h5>Responsable</h5>
                        <p><strong>Nom d'utilisateur :</strong> {{ $sinistre->contrat->utilisateur->nom_utilisateur }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->can('valider', $sinistre) || Auth::user()->can('refuser', $sinistre))
            @if ($sinistre->status === null || $sinistre->status == 'en cours')
                <div class="card mt-3 shadow-sm border-0 rounded-3">
                    <div class="card-header fw-bold">Décision :</div>
                    <div class="card-body d-flex justify-content-around align-items-center">
                        <a href="{{ route('sinistre.valider', $sinistre) }}"
                            class="btn btn-sm btn-success d-flex align-items-center"
                            onclick="return confirm('Êtes-vous sûr de vouloir valider ce sinistre ?')">
                            <i class="fas fa-check me-2"></i> Valider
                        </a>
                        <a href="{{ route('sinistre.refuser', $sinistre) }}"
                            class="btn btn-sm btn-danger d-flex align-items-center"
                            onclick="return confirm('Êtes-vous sûr de vouloir refuser ce sinistre ?')">
                            <i class="fas fa-times me-2"></i> Refuser
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-info mt-3">
                    Décision prise : <strong>{{ ucfirst($sinistre->status) }}</strong>.
                    Il n'est plus possible de modifier.
                </div>
            @endif
        @endif



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
