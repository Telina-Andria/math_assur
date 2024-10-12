@extends('Layouts/dashboard')

@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Modifier le contrat</h1>
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

        <form action="{{ route('contrat.update', $contrat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="numero_contrat" class="form-label">Numéro de contrat</label>
                        <input type="text" class="form-control" id="numero_contrat" name="numero_contrat" required
                            value="{{ old('numero_contrat', $contrat->numero_contrat) }}" readonly>
                        <small class="form-text text-muted">Le numéro de contrat ne peut pas être modifié.</small>
                    </div>
                    <div class="mb-3">
                        <label for="type_contrat" class="form-label">Type de contrat</label>
                        <select class="form-select" id="type_contrat" name="type_contrat" required>
                            <option value="vie"
                                {{ old('type_contrat', $contrat->type_contrat) == 'vie' ? 'selected' : '' }}>Vie</option>
                            <option value="non vie"
                                {{ old('type_contrat', $contrat->type_contrat) == 'non vie' ? 'selected' : '' }}>Non vie
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="montant_assure" class="form-label">Montant assuré</label>
                        <div class="input-group">
                            <span class="input-group-text">Ar</span>
                            <input type="number" class="form-control" id="montant_assure" name="montant_assure"
                                step="0.01" min="0" required value="{{ $contrat->montant_assure }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duree_contrat" class="form-label">Durée du contrat (en mois)</label>
                        <input type="number" class="form-control" id="duree_contrat" name="duree_contrat" min="1"
                            required value="{{ $contrat->duree_contrat }}">
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required
                            value="{{ $contrat->date_fin }}">
                    </div>
                </div>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcul automatique de la date de fin
            const dureeContratInput = document.getElementById('duree_contrat');
            const dateFinInput = document.getElementById('date_fin');

            dureeContratInput.addEventListener('input', function() {
                const today = new Date();
                const duree = parseInt(this.value) || 0;
                const dateFin = new Date(today.setMonth(today.getMonth() + duree));
                dateFinInput.value = dateFin.toISOString().split('T')[0];
            });
        });
    </script>
@endpush
