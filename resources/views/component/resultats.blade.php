@extends('layouts.app')
@section('content')
<div id="section-accueil">
    <section class="py-5">
        <div class="container">
            <form action="{{ route('recherche') }}" method="POST" id="search-form">
                @csrf
                <div class="search-form">
                    <div class="from-to-group">
                        <select name="villeDepart" id="villeDepart" class="from-to-input">
                            <option value="">Ville de départ</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                            @endforeach
                        </select>
                        <div class="swap-icon"><i class="fas fa-exchange-alt"></i></div>
                        <select name="villeArrivee" id="villeArrivee" class="from-to-input">
                            <option value="">Ville de destination</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="date-group">
                        <div class="date-label">Départ</div>
                        <div class="date-input">
                            <input type="date" class="date-field" id="dateDepart" name="dateDepart" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="date-group">
                        <div class="date-label">Retour (Optionnel)</div>
                        <div class="date-input">
                            <input type="date" class="date-field" id="dateRetourAccueil" name="dateArrivee" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <button type="submit" class="find-tickets-btn">Trouver des Billets</button>
                </div>
            </form>
        </div>
    </section>
    
    <div id="loader" style="display:none;" class="text-center mt-5">
        <div class="spinner-border text-success" role="status"></div>
        <p>Nous recherchons les meilleurs trajets pour vous...</p>
    </div>
</div>

<div id="section-resultats" style="display:none;">
    
    <div class="search-compact">
        <div class="container">
            <form id="search-form-compact">
                <div class="search-form">
                    <div class="from-to-group">
                        <select id="compact-depart" class="from-to-input">
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                            @endforeach
                        </select>
                        <div class="swap-icon"><i class="fas fa-exchange-alt"></i></div>
                        <select id="compact-arrivee" class="from-to-input">
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="date-group">
                        <div class="date-label">Partir</div>
                        <div class="date-input">
                            <input type="date" class="date-field" id="compact-dateDepart">
                        </div>
                    </div>

                    <div class="date-group">
                        <div class="date-label">Retour</div>
                        <div class="date-input">
                            <input type="date" class="date-field" id="compact-dateRetour">
                        </div>
                    </div>

                    <button type="submit" class="find-tickets-btn">Rechercher À Nouveau</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-4">
        <div class="route-info-box text-center mb-4">
            <h4 id="dynamique-route">...</h4>
            <p id="resumeRecherche"></p>
        </div>

        <div class="results-grid" style="display: flex; gap: 20px;">
            <aside class="filters-panel" style="flex: 1;">
                @include('partials.filters')
            </aside>

            <main class="bus-results-panel" style="flex: 3;">
                <div id="tripsWrapper">
                    </div>
            </main>
        </div>
    </div>
</div>
@endsection