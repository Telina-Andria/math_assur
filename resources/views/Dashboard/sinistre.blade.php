@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste des Sinistres</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm" id="sinistresTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Numéro de sinistre</th>
                        <th>Contrat</th>
                        <th>Montant indemnisé</th>
                        <th>Responsable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sinistres as $sinistre)
                        <tr>
                            <td>{{ $sinistre->id }}</td>
                            <td><a href="{{ route('sinistre.show', $sinistre) }}">{{ $sinistre->numero_sinistre }}</a>
                            </td>
                            <td><a
                                    href="{{ route('contrat.show', $sinistre->contrat) }}">{{ $sinistre->contrat->numero_contrat ?? 'Non assigné' }}</a>
                            </td>
                            <td>{{ number_format($sinistre->montant_indemnise, 2, ',', ' ') }} Ar</td>
                            <td>{{ $sinistre->utilisateur->nom_utilisateur ?? 'Non assigné' }}</td>
                            <td>
                                <a href="{{ route('sinistre.show', $sinistre) }}" class="btn btn-info btn-sm"
                                    title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sinistre.edit', $sinistre) }}" class="btn btn-warning btn-sm"
                                    title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

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
            $('#sinistresTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                }
            });
        });
    </script>
@endpush
