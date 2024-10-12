@extends('Layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">Connexion</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login.store') }}" method="POST" class="d-inline"
                            enctype="multipart/form-data">
                            @csrf

                            @if (session('error'))
                                <div class="alert alert-danger mb-3">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nom_utilisateur" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control @error('nom_utilisateur') is-invalid @enderror"
                                    id="nom_utilisateur" name="nom_utilisateur" value="{{ old('nom_utilisateur') }}"
                                    placeholder="Entrez votre nom d'utilisateur" required>
                                @error('nom_utilisateur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('mot_de_passe') is-invalid @enderror"
                                    id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
                                @error('mot_de_passe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>
                        <div class="d-grid mt-2">
                            <a href="{{ route('register') }}" class="btn btn-primary text-white">S'inscrire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
