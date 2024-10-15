@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Détails du Contrat</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @if (Auth::user()->can('update', $contrat))
                    <a href="{{ route('contrat.edit', $contrat) }}" class="btn btn-sm btn-outline-primary ml-2">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                @endif

                <a href="{{ route('sinistre.create', $contrat) }}" class="btn btn-sm btn-outline-primary ml-2">
                    <i class="fas fa-exclamation-triangle"></i> Nouvelle Sinistre
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
                        Informations du Contrat
                    </div>
                    <div class="card-body">
                        <p><strong>Numéro de contrat :</strong> {{ $contrat->numero_contrat }}</p>
                        <p><strong>Type de contrat :</strong> {{ ucfirst($contrat->type_contrat) }}</p>
                        <p><strong>Montant assuré :</strong> {{ number_format($contrat->montant_assure, 2) }} Ar</p>
                        <p><strong>Date Souscription :</strong> {{ $contrat->created_at }} </p>
                        <p><strong>Durée du contrat :</strong> {{ $contrat->duree_contrat }} mois</p>
                        <p><strong>Date de fin :</strong> {{ $contrat->date_fin }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Informations associées
                    </div>
                    <div class="card-body">
                        <h5>Client</h5>
                        <p><strong>Nom :</strong> {{ $contrat->client->nom }}</p>
                        <p><strong>Prénom :</strong> {{ $contrat->client->prenom }}</p>
                        <p><strong>Type de client :</strong> {{ $contrat->client->type_client }}</p>
                        <a href="{{ route('client.show', $contrat->client) }}" class="btn btn-sm btn-info">Voir le
                            profil du client</a>

                        <hr>

                        <h5>Utilisateur responsable</h5>
                        <p><strong>Nom d'utilisateur :</strong> {{ $contrat->utilisateur->nom_utilisateur }}</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Historique des modifications</h3>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur Responsable</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contrat->historiqueContrat()->orderBy('created_at', 'desc')->get() as $historique)
                        <tr>
                            <td>{{ $historique->created_at }}</td>
                            <td>{{ $historique->utilisateur_responsable }}</td>
                            <td>
                                @if ($historique->details)
                                    <ul>
                                        @foreach (json_decode($historique->details, true) as $field => $changes)
                                            <li>
                                                {{ ucfirst($field) }} :
                                                <span class="text-danger">{{ $changes['old'] }}</span> ->
                                                <span class="text-success">{{ $changes['new'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    Aucun détail disponible
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun historique disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <h3>Liste des sinistres associés</h3>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Numéro de sinistre</th>
                        <th>Date de déclaration</th>
                        <th>Montant indemnisé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contrat->sinistre as $sinistre)
                        <tr>
                            <td>{{ $sinistre->numero_sinistre }}</td>
                            <td>{{ $sinistre->created_at }}</td>
                            <td>{{ number_format($sinistre->montant_indemnise, 2) }} Ar</td>
                            <td>
                                <a href="{{ route('sinistre.show', $sinistre) }}" class="btn btn-sm btn-info">Voir</a>
                                @if (Auth::user()->can('update', $sinistre))
                                    <a href="{{ route('sinistre.edit', $sinistre) }}"
                                        class="btn btn-sm btn-warning">Modifier</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun sinistre associé à ce contrat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <form action="{{ route('contrat.destroy', $contrat) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">
                    <i class="fas fa-trash"></i> Supprimer le contrat
                </button>
            </form>
        </div>
    </main>
@endsection
