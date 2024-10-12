@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Enregistrer un nouveau sinistre</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sinistre.store', $contrat->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="numero_contrat" class="form-label">Numéro de contrat</label>
                <input type="text" class="form-control" id="numero_contrat" name="numero_contrat" required
                    value="{{ old('numero_contrat', $contrat->numero_contrat) }}" readonly>
                <small class="form-text text-muted">Le numéro de contrat ne peut pas être modifié.</small>
            </div>
            <div class="mb-3">
                <label for="numero_sinistre" class="form-label">Numéro de sinistre</label>
                <input type="text" class="form-control" id="numero_sinistre" name="numero_sinistre" required>
            </div>
            <div class="mb-3">
                <label for="montant_indemnise" class="form-label">Montant indemnisé (Ar)</label>
                <input type="number" step="0.01" class="form-control" id="montant_indemnise" name="montant_indemnise"
                    required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Enregister le sinistre</button>
                    <a href="{{ route('contrat.show', $contrat) }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script></script>
@endpush
