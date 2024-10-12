@extends('Layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="text-center mb-0">Inscription</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="POST" id="registrationForm">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_utilisateur" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" selected disabled>Choisissez un rôle</option>
                                    <option value="direction">Direction</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                            </div>
                            <div class="mb-3">
                                <label for="mot_de_passe_confirmation" class="form-label">Confirmation du mot de
                                    passe</label>
                                <input type="password" class="form-control" id="mot_de_passe_confirmation"
                                    name="mot_de_passe_confirmation" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
