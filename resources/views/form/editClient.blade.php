@extends('Layouts/dashboard')
@section('dashboard-content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Modifier le client</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('client.update', $client) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                            name="nom" value="{{ old('nom', $client->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom"
                            name="prenom" value="{{ old('prenom', $client->prenom) }}" required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse"
                            name="adresse" value="{{ old('adresse', $client->adresse) }}" required>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_naissance" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                            id="date_naissance" name="date_naissance"
                            value="{{ old('date_naissance', $client->date_naissance) }}" required>
                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type_client" class="form-label">Type de client</label>
                        <select class="form-select @error('type_client') is-invalid @enderror" id="type_client"
                            name="type_client" required>
                            <option value="" disabled>Choisissez un type</option>
                            <option value="individuel"
                                {{ old('type_client', $client->type_client) == 'individuel' ? 'selected' : '' }}>Individuel
                            </option>
                            <option value="groupe"
                                {{ old('type_client', $client->type_client) == 'groupe' ? 'selected' : '' }}>Groupe
                            </option>
                        </select>
                        @error('type_client')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour le client</button>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </main>
@endsection
