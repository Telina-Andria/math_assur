<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('bs5/css/bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            min-height: calc(100vh - 56px - 60px);
        }

        .content {
            flex: 1;
        }

        .footer {
            height: 60px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="/api/placeholder/150/50" alt="Logo" height="30" class="d-inline-block align-text-top">
            </a>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-2">
                    {{ Auth::user()->nom_utilisateur }}
                    @if (Auth::user()->role == 0)
                        (Administrateur)
                    @elseif(Auth::user()->role == 1)
                        (Direction)
                    @else
                        (Agent)
                    @endif
                </span>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-edit me-2"></i>Modifier le
                                profil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('client.index') }}">
                                <i class="fas fa-users me-2"></i>
                                Liste des clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contrat.index') }}">
                                <i class="fas fa-file-contract me-2"></i>
                                Liste des contrats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sinistre.index') }}">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Liste des sinistres
                            </a>
                        </li>
                        @if (Auth::user()->role == 0)
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-users me-2"></i>
                                    Liste des Employees
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>

            @yield('dashboard-content')

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light pt-3">
        <div class="container-fluid">
            <div class="row align-items-center h-100">
                <div class="col-auto">
                    <img src="/api/placeholder/100/30" alt="Logo" height="30">
                </div>
                <div class="col text-center">
                    <span>&copy; 2024 Math Assurance. Tous droits réservés.</span>
                    <span>&copy; ANDRIANARIMANANA Telina Arintsoa</span>
                </div>
                <div class="col-auto">
                    <a href="#" class="text-muted me-2">Mentions légales</a>
                    <a href="#" class="text-muted">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>


{{-- <h1>Sidebar</h1> --}}
