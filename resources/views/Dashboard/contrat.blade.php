@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste des Contrats</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm" id="contratsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Numéro de contrat</th>
                        <th>Client</th>
                        <th>Type de contrat</th>
                        <th>Montant assuré</th>
                        <th>Date de Souscription</th>
                        <th>Durée (mois)</th>
                        <th>Date de fin</th>
                        <th>Responsable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contrats as $contrat)
                        <tr>
                            <td>{{ $contrat->id }}</td>
                            <td><a href="{{ route('contrat.show', $contrat) }}">{{ $contrat->numero_contrat }}</a></td>
                            <td>{{ $contrat->client->nom }} {{ $contrat->client->prenom }}</td>
                            <td>{{ $contrat->type_contrat }}</td>
                            <td>{{ number_format($contrat->montant_assure, 2) }} Ar</td>
                            <td>{{ $contrat->created_at }}
                            <td>{{ $contrat->duree_contrat }}</td>
                            <td>{{ $contrat->date_fin }}</td>
                            <td>{{ $contrat->utilisateur->nom_utilisateur }}</td>
                            <td>
                                <a href="{{ route('contrat.show', $contrat) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if (Auth::user()->can('update', $contrat))
                                    <a href="{{ route('contrat.edit', $contrat) }}" class="btn btn-warning btn-sm"
                                        title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contratsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                }
            });
        });
    </script>
@endpush
