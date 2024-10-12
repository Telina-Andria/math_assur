@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste des Clients</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('client.create') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-plus"></i> Ajouter un client
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm" id="clientsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Type de client</th>
                        <th>Createur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td><a href="{{ route('client.show', $client) }}">{{ $client->nom }}</a></td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ $client->type_client }}</td>
                            <td>{{ $client->utilisateur->nom_utilisateur ?? 'Non assigné' }}</td>
                            <td>
                                <a href="{{ route('client.show', $client) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('client.edit', $client) }}" class="btn btn-warning btn-sm"
                                    title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('client.destroy', $client) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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
            $('#clientsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                }
            });
        });
    </script>
@endpush
