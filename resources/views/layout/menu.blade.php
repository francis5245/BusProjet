<!-- Header -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('asset/image/icone.png') }}" alt="BUS365">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item"><a class="nav-link" href="{{ route('accueil') }}"><i class="fas fa-home me-1"></i><font _mstmutation="1" _msttexthash="92079" _msthash="2">Accueil</font></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/work"><i class="fas fa-question-circle me-1"></i><font _mstmutation="1" _msttexthash="354536" _msthash="3">Comment Travailler</font></a></li>
                <li class="nav-item"><a class="nav-link" href="/blog"><i class="fas fa-blog me-1"></i><font _mstmutation="1" _msttexthash="43615" _msthash="4">Blog</font></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-map-marker-alt me-1"></i><font _mstmutation="1" _msttexthash="61178" _msthash="5">Piste</font></a>
                </li>

                <!-- Auth / Guest -->
                @if (Route::has('login'))
                    @auth
                        @if (request()->routeIs('accueil') || request()->is('work') || request()->is('blog'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-dark px-4" href="{{route('dashboard')}}">
                                    Dashboard
                                </a>
                            </li>
                        @endif
                        @if (request()->routeIs('dashboard') || request()->is('profile') || request()->is('profile/*'))
                        <li class="nav-item dropdown ms-lg-3 mt-2 mt-lg-0">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : (isset(Auth::user()->image) ? asset('storage/' . Auth::user()->image) : asset('asset/image/default-avatar.png')) }}" class="rounded-circle me-2" style="width:32px; height:32px; object-fit:cover;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                {{-- <li>
                                    @if (Route::has('profile.show'))
                                        <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>Profil</a>
                                    @else
                                        <a class="dropdown-item" href="{{ url('/profile') }}"><i class="fas fa-user me-2"></i>Profil</a>
                                    @endif
                                </li> --}}
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif

                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-dark px-4 me-2" href="{{ route('login') }}">
                                Connectez-vous
                            </a>
                        </li>

                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-dark px-4" href="{{ route('register') }}">
                                    S’inscrire
                                </a>
                            </li>
                        @endif --}}
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>

