@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Modifier le Sinistre</h1>
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

        <form action="{{ route('sinistre.update', $sinistre) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="numero_sinistre" class="form-label">Numéro de sinistre</label>
                <input type="text" class="form-control" id="numero_sinistre" name="numero_sinistre"
                    value="{{ old('numero_sinistre', $sinistre->numero_sinistre) }}" readonly>
                <small class="form-text text-muted">Le numéro de sinistre ne peut pas être modifié.</small>
            </div>

            <div class="mb-3">
                <label for="montant_indemnise" class="form-label">Montant indemnisé</label>
                <input type="number" step="0.01" class="form-control" id="montant_indemnise" name="montant_indemnise"
                    value="{{ old('montant_indemnise', $sinistre->montant_indemnise) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $sinistre->description) }}</textarea>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Mettre à jour le contrat</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </main>
@endsection
