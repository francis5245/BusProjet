<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vérification Email - Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/profil.css') }}">
</head>

<body>
    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg main-navbar">
  <div class="container">
   <a class="navbar-brand" href="/">
                <img src="{{ asset('asset/image/icone.png') }}" alt="BUS365">
            </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
            @auth
                {{ Auth::user()->name }}
            @else
                Invité
            @endauth
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li class="dropdown-header">
              @auth
                <strong>{{ Auth::user()->name }}</strong><br>
                <small class="text-muted">{{ Auth::user()->email }}</small>
              @else
                <strong>Invité</strong><br>
                <small class="text-muted"></small>
              @endauth
            </li>
            <li><hr class="dropdown-divider"></li>
            {{-- <li>
              <a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i>Profil</a>
            </li> --}}
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fa fa-sign-out-alt me-2"></i> Déconnexion
                </button>
              </form>
            </li>

          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
{{ $slot }}
</body>

</html>
