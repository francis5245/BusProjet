@extends('layout.template')
@section('title', 'Dashboard Client')
@section('contenu')

    <!-- ================= PROFILE COVER ================= -->
    <div class="position-relative">
        <img src="https://images.unsplash.com/photo-1509749837427-ac94a2553d0e" class="w-100"
            style="height:320px; object-fit:cover;">

        <!-- Overlay avec dégradé -->
        <div class="position-absolute top-0 start-0 w-100 h-100 profile-overlay"></div>

        <!-- Profile info -->
        <div class="position-absolute bottom-0 start-0 p-4 text-white d-flex align-items-end w-100">
            <div class="position-relative me-3">
                <form id="profile-photo-form" action="{{ route('profile.updatePhoto') }}" method="POST"
                    enctype="multipart/form-data" class="d-inline-block position-relative">
                    @csrf
                    @method('PUT')
                    <img id="profilePhotoImg"
                        src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('asset/image/Avatar.jpg') }}"
                        class="rounded-circle border border-4 border-white shadow"
                        style="width:130px; height:130px; object-fit:cover;">

                    <input type="file" name="photo" id="profilePhotoInput" accept="image/*" style="display:none;">

                    <span
                        class="position-absolute bottom-0 end-0 bg-success rounded-circle d-flex justify-content-center align-items-center shadow profile-photo-change"
                        style="width:36px; height:36px; cursor:pointer;" title="Changer la photo">
                        <i class="fas fa-camera text-white"></i>
                    </span>
                </form>
            </div>

            <div class="flex-grow-1">
                <h2 class="mb-1">Henry Jonas</h2>
                <p class="mb-2 text-light"><i class="fas fa-calendar-alt me-1"></i> Membre depuis : Novembre 2023</p>
                <div class="d-flex flex-wrap gap-3">
                    <span class="d-flex align-items-center">
                        <i class="fas fa-ticket me-2"></i>
                        <span>12 tickets</span>
                    </span>
                    <span class="d-flex align-items-center">
                        <i class="fas fa-star me-2 text-warning"></i>
                        <span>4.8/5 évaluations</span>
                    </span>
                    <span class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2 text-success"></i>
                        <span>Vérifié</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= CONTENT ================= -->
    <div class="container my-5">
        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-success">
                            <i class="bi bi-menu-button me-2"></i>Menu
                        </h5>
                        <nav class="nav flex-column">
                            <a href="#" class="nav-link py-2 px-3 mb-1 rounded
   @if(Auth::user()->has_tickets) active bg-success text-white @endif"
   data-target="tickets-section">
                                <i class="bi bi-ticket-perforated me-2"></i> Tickets
                            </a>
                           <a href="#"
   class="nav-link py-2 px-3 mb-1 rounded
   @if(request()->is('profile')) active bg-success text-white @endif"
   data-target="profile-section">
   <i class="bi bi-person me-2"></i> Profile
</a>

                           <a href="#"
   class="nav-link py-2 px-3 mb-1 rounded
   @if(Auth::user()->can_change_password) active bg-success text-white @endif"
   data-target="change-password-section">
   <i class="bi bi-key me-2"></i> Change mot de passe
</a>
                           <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</button>
                                    </form>
                                </li>
                        </nav>
                    </div>
                </div>

                <!-- Carte info rapide -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="bi bi-info-circle me-2"></i>Information rapide
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <small class="text-muted">Email</small>
                                <div>{{ Auth::user()->email }}</div>
                            </li>
                            <li class="mb-2">
                                <small class="text-muted">Téléphone</small>
                                <div>{{ Auth::user()->phone ?? '+229 00 00 00 00' }}</div>
                            </li>
                            <li>
                                <small class="text-muted">Statut</small>
                                <div>
                                    @if (Auth::user()->status ?? true)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-secondary">Inactif</span>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- MAIN CONTENT -->
            <div class="col-lg-9">
                <!-- SECTION PROFILE (visible par défaut) -->
                <div id="profile-section" class="dashboard-section">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 mb-0">
                                <i class="bi bi-person-badge me-2"></i>Profile Information
                            </h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                {{-- Affichage des erreurs --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Message de succès --}}
                                @if (session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-person me-1"></i>Nom complet
                                        </label>
                                        <input type="text" name="name" class="form-control form-control-lg"
                                            value="{{ old('name', Auth::user()->name) }}" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <button type="submit" class="btn btn-success btn-lg px-4">
                                        <i class="bi bi-check-circle me-2"></i> Mettre à jour
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- SECTION TICKETS (cachée par défaut) -->
                <div id="tickets-section" class="dashboard-section" style="display:none;">
                    <!-- Header avec recherche -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0"><i class="fas fa-ticket-alt me-2 text-success"></i>Mes tickets</h4>
                                <p class="text-muted mb-0 mt-1">Gérez vos réservations et vos voyages</p>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Rechercher un ticket...">
                                    <button class="btn btn-success" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 1 -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4 ticket-card">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <div class="mb-3 mb-md-0">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="mb-0">Cox's Bazar - Dhaka</h5>
                                    <span class="badge bg-success badge-status ms-2">Confirmé</span>
                                </div>
                                <p class="text-muted mb-2">
                                    <i class="far fa-calendar-alt me-1"></i>2024-11-14 •
                                    <i class="far fa-clock ms-2 me-1"></i>10:00 PM
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-bus me-1"></i>Volvo AC
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-chair me-1"></i>Siège 12A
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-tag me-1"></i>2500 BDT
                                    </span>
                                </div>
                            </div>

                            <div class="text-start text-md-end">
                                <div class="mb-3">
                                    <small class="text-muted">ID de réservation :</small>
                                    <strong class="text-success d-block">TBFHPDCY19</strong>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-success btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#rateModal" data-ticket-id="TBFHPDCY19">
                                        <i class="fas fa-star me-1"></i>Évaluer
                                    </button>
                                    <button class="btn btn-outline-success btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#invoiceModal"
                                        data-ticket-id="TBFHPDCY19">
                                        <i class="fas fa-file-invoice me-1"></i>Facture
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#viewModal" data-ticket-id="TBFHPDCY19">
                                        <i class="fas fa-eye me-1"></i>Voir
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#cancelModal" data-ticket-id="TBFHPDCY19">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 2 -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4 ticket-card">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <div class="mb-3 mb-md-0">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="mb-0">Rangpur - Cox's Bazar</h5>
                                    <span class="badge bg-warning text-dark badge-status ms-2">À venir</span>
                                </div>
                                <p class="text-muted mb-2">
                                    <i class="far fa-calendar-alt me-1"></i>2024-11-13 •
                                    <i class="far fa-clock ms-2 me-1"></i>10:00 PM
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-bus me-1"></i>Scania AC
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-chair me-1"></i>Siège 08B
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-tag me-1"></i>3200 BDT
                                    </span>
                                </div>
                            </div>

                            <div class="text-start text-md-end">
                                <div class="mb-3">
                                    <small class="text-muted">ID de réservation :</small>
                                    <strong class="text-success d-block">TBS1EO5WGY</strong>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-outline-success btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#invoiceModal"
                                        data-ticket-id="TBS1EO5WGY">
                                        <i class="fas fa-file-invoice me-1"></i>Facture
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#viewModal" data-ticket-id="TBS1EO5WGY">
                                        <i class="fas fa-eye me-1"></i>Voir
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#cancelModal" data-ticket-id="TBS1EO5WGY">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 3 (Complété) -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4 ticket-card">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <div class="mb-3 mb-md-0">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="mb-0">Dhaka - Chittagong</h5>
                                    <span class="badge bg-secondary badge-status ms-2">Complété</span>
                                </div>
                                <p class="text-muted mb-2">
                                    <i class="far fa-calendar-alt me-1"></i>2024-10-28 •
                                    <i class="far fa-clock ms-2 me-1"></i>08:00 AM
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-bus me-1"></i>Hino AC
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-chair me-1"></i>Siège 15C
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-tag me-1"></i>1800 BDT
                                    </span>
                                </div>
                            </div>

                            <div class="text-start text-md-end">
                                <div class="mb-3">
                                    <small class="text-muted">ID de réservation :</small>
                                    <strong class="text-success d-block">TB9XK2PLR4</strong>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-success btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#rateModal" data-ticket-id="TB9XK2PLR4">
                                        <i class="fas fa-star me-1"></i>Évaluer
                                    </button>
                                    <button class="btn btn-outline-success btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#invoiceModal"
                                        data-ticket-id="TB9XK2PLR4">
                                        <i class="fas fa-file-invoice me-1"></i>Facture
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#viewModal" data-ticket-id="TB9XK2PLR4">
                                        <i class="fas fa-eye me-1"></i>Voir
                                    </button>
                                    <button class="btn btn-outline-info btn-sm d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#rebookModal" data-ticket-id="TB9XK2PLR4">
                                        <i class="fas fa-redo me-1"></i>Réserver à nouveau
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link">
                                    <i class="fas fa-chevron-left me-1"></i>Précédent
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link bg-success border-success">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-success">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-success">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-success">
                                    Suivant<i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Stats résumé -->
                    <div class="bg-white shadow-sm rounded p-4 mt-5">
                        <h5 class="mb-4"><i class="fas fa-chart-bar me-2 text-success"></i>Statistiques de voyage</h5>
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-success mb-1">12</h3>
                                    <p class="mb-0 text-muted">Tickets</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-success mb-1">8</h3>
                                    <p class="mb-0 text-muted">Complétés</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-success mb-1">3</h3>
                                    <p class="mb-0 text-muted">À venir</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-success mb-1">1</h3>
                                    <p class="mb-0 text-muted">Annulés</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION CHANGE PASSWORD (cachée par défaut) -->
                <div id="change-password-section" class="dashboard-section" style="display:none;">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 mb-0"><i class="bi bi-key me-2"></i>Changer le mot de passe</h2>
                        </div>
                        <div class="card-body">
                            <form id="change-password-form" method="POST"
                                action="{{ route('profile.updatePassword') }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe actuel</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirmer le mot de passe</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Changer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODALS ================= -->

    <!-- Modal Évaluation -->
    <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="rateModalLabel">
                        <i class="fas fa-star me-2"></i>Évaluer le voyage
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h6>Trajet: <span id="rateTicketRoute"></span></h6>
                        <p class="text-muted">ID: <span id="rateTicketId"></span></p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Note globale</label>
                        <div class="text-center">
                            <div class="star-rating mb-3">
                                <i class="far fa-star fa-2x star" data-value="1"></i>
                                <i class="far fa-star fa-2x star" data-value="2"></i>
                                <i class="far fa-star fa-2x star" data-value="3"></i>
                                <i class="far fa-star fa-2x star" data-value="4"></i>
                                <i class="far fa-star fa-2x star" data-value="5"></i>
                            </div>
                            <input type="hidden" id="ratingValue" name="rating" value="0">
                            <p id="ratingText" class="text-muted">Cliquez sur les étoiles pour noter</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Commentaire</label>
                        <textarea class="form-control" rows="4" placeholder="Partagez votre expérience de voyage..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Points à évaluer</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="comfortCheck">
                            <label class="form-check-label" for="comfortCheck">Confort du bus</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="punctualityCheck">
                            <label class="form-check-label" for="punctualityCheck">Ponctualité</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="driverCheck">
                            <label class="form-check-label" for="driverCheck">Conduite du chauffeur</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="cleanlinessCheck">
                            <label class="form-check-label" for="cleanlinessCheck">Propreté</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="submitRating">
                        <i class="fas fa-paper-plane me-1"></i>Soumettre l'évaluation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Facture -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="invoiceModalLabel">
                        <i class="fas fa-file-invoice me-2"></i>Facture - <span id="invoiceTicketId"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations du client</h6>
                            <p class="mb-1"><strong>Nom:</strong> Henry Jonas</p>
                            <p class="mb-1"><strong>Email:</strong> henry@example.com</p>
                            <p class="mb-1"><strong>Téléphone:</strong> +1 (555) 123-4567</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6>Détails de la facture</h6>
                            <p class="mb-1"><strong>Date:</strong> <span id="invoiceDate"></span></p>
                            <p class="mb-1"><strong>N° Facture:</strong> INV-<span id="invoiceNumber"></span></p>
                            <p class="mb-1"><strong>Statut:</strong> <span class="badge bg-success">Payé</span></p>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6>Détails du trajet</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Itinéraire</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Bus</th>
                                        <th>Siège</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="invoiceRoute"></td>
                                        <td id="invoiceTripDate"></td>
                                        <td id="invoiceTripTime"></td>
                                        <td id="invoiceBus"></td>
                                        <td id="invoiceSeat"></td>
                                        <td id="invoicePrice"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6>Méthode de paiement</h6>
                            <p><i class="fas fa-credit-card me-2"></i>Carte de crédit (**** 1234)</p>
                        </div>
                        <div class="col-md-6">
                            <div class="text-end">
                                <p><strong>Total:</strong> <span id="invoiceTotal" class="h5 text-success"></span></p>
                                <p class="text-muted"><small>Taxes incluses</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-outline-success">
                        <i class="fas fa-print me-1"></i>Imprimer
                    </button>
                    <button type="button" class="btn btn-success">
                        <i class="fas fa-download me-1"></i>Télécharger PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Voir Détails -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="viewModalLabel">
                        <i class="fas fa-ticket-alt me-2"></i>Détails du ticket - <span id="viewTicketId"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <h6 class="card-title text-success">Itinéraire</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h4 id="viewDeparture" class="mb-1"></h4>
                                            <p class="text-muted mb-0" id="viewDepartureTime"></p>
                                        </div>
                                        <div class="text-center flex-grow-1 mx-4">
                                            <div class="position-relative">
                                                <div class="dashed-line"></div>
                                                <i
                                                    class="fas fa-bus text-success position-absolute top-50 start-50 translate-middle bg-white p-2"></i>
                                            </div>
                                            <p class="text-muted mt-2" id="viewDuration"></p>
                                        </div>
                                        <div class="text-end">
                                            <h4 id="viewArrival" class="mb-1"></h4>
                                            <p class="text-muted mb-0" id="viewArrivalTime"></p>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted">Bus</small>
                                            <p class="mb-0 fw-semibold" id="viewBusType"></p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted">Siège</small>
                                            <p class="mb-0 fw-semibold" id="viewSeatNumber"></p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted">Prix</small>
                                            <p class="mb-0 fw-semibold text-success" id="viewTicketPrice"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-success">QR Code</h6>
                                    <div class="text-center">
                                        <div class="d-inline-block p-3 border rounded">
                                            <!-- Placeholder pour QR Code -->
                                            <canvas id="qrCodeCanvas" width="150" height="150"></canvas>
                                        </div>
                                        <p class="text-muted mt-2">Présentez ce QR code à l'embarquement</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <h6 class="card-title text-success">Statut</h6>
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <span class="badge bg-success fs-6 p-2" id="viewStatusBadge">Confirmé</span>
                                        </div>
                                        <p class="text-muted"><small id="viewStatusMessage"></small></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-success">Instructions</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-clock text-success me-2"></i>
                                            <small>Présentez-vous 30min avant le départ</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-id-card text-success me-2"></i>
                                            <small>Pièce d'identité requise</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-suitcase text-success me-2"></i>
                                            <small>Bagage: 20kg maximum</small>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone text-success me-2"></i>
                                            <small>Contact: +1 (555) 123-4567</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-outline-success">
                        <i class="fas fa-share-alt me-1"></i>Partager
                    </button>
                    <button type="button" class="btn btn-success" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Annulation -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="cancelModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Annuler la réservation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-times-circle fa-3x text-danger"></i>
                        </div>
                        <h5>Êtes-vous sûr de vouloir annuler ce ticket ?</h5>
                        <p class="text-muted">Ticket ID: <strong id="cancelTicketId"></strong></p>
                        <p class="text-muted">Trajet: <strong id="cancelTicketRoute"></strong></p>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-circle me-2"></i>Conditions d'annulation</h6>
                        <ul class="mb-0">
                            <li>Annulation gratuite jusqu'à 24h avant le départ</li>
                            <li>50% de frais si annulé moins de 24h avant</li>
                            <li>Aucun remboursement si annulé moins de 2h avant</li>
                            <li>Le remboursement sera traité sous 5-7 jours ouvrables</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Raison de l'annulation (optionnel)</label>
                        <select class="form-select" id="cancelReason">
                            <option value="">Sélectionner une raison</option>
                            <option value="change_plans">Changement de plans</option>
                            <option value="found_cheaper">Trouvé un meilleur prix</option>
                            <option value="scheduling_conflict">Conflit d'horaire</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>

                    <div class="mb-3" id="otherReasonDiv" style="display:none;">
                        <label class="form-label">Veuillez préciser</label>
                        <textarea class="form-control" rows="2" placeholder="Décrivez votre raison..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne pas annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmCancel">
                        <i class="fas fa-times me-1"></i>Confirmer l'annulation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Réserver à nouveau -->
    <div class="modal fade" id="rebookModal" tabindex="-1" aria-labelledby="rebookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="rebookModalLabel">
                        <i class="fas fa-redo me-2"></i>Réserver à nouveau
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h5>Voulez-vous réserver le même trajet ?</h5>
                        <p class="text-muted">Trajet précédent: <strong id="rebookTicketRoute"></strong></p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Date de voyage souhaitée</label>
                        <input type="date" class="form-control" id="rebookDate" min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nombre de passagers</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="decrementPassengers">-</button>
                            <input type="text" class="form-control text-center" value="1" id="passengerCount"
                                readonly>
                            <button class="btn btn-outline-secondary" type="button" id="incrementPassengers">+</button>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Nous vous proposerons des horaires disponibles pour la date sélectionnée.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="proceedRebook">
                        <i class="fas fa-arrow-right me-1"></i>Voir les disponibilités
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Photo upload
            var changeBtn = document.querySelector('.profile-photo-change');
            var input = document.getElementById('profilePhotoInput');
            var img = document.getElementById('profilePhotoImg');

            if (changeBtn && input) {
                changeBtn.addEventListener('click', function() {
                    input.click();
                });
            }

            if (input && img) {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        var file = this.files[0];
                        img.src = URL.createObjectURL(file);
                        document.getElementById('profile-photo-form').submit();
                    }
                });
            }

            // Section toggling
            var navLinks = document.querySelectorAll('nav .nav-link[data-target]');
            var sections = document.querySelectorAll('.dashboard-section');

            function showSection(id, link) {
                sections.forEach(function(s) {
                    s.style.display = 'none';
                });

                var el = document.getElementById(id);
                if (el) el.style.display = 'block';

                navLinks.forEach(function(n) {
                    n.classList.remove('active', 'bg-success', 'text-white');
                });

                if (link) {
                    link.classList.add('active', 'bg-success', 'text-white');
                }
            }

            navLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = this.getAttribute('data-target');
                    if (target === 'logout-section') {
                        window.location.href = "{{ route('logout') }}";
                        return;
                    }
                    if (!target) return;
                    showSection(target, this);
                });
            });

            showSection('profile-section', document.querySelector('nav .nav-link.active'));

            // ================= GESTION DES MODALS =================

            // Système d'évaluation par étoiles
            const stars = document.querySelectorAll('.star-rating .star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    document.getElementById('ratingValue').value = value;

                    // Mettre à jour l'affichage des étoiles
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-value')) <= value) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'text-warning');
                        } else {
                            s.classList.remove('fas', 'text-warning');
                            s.classList.add('far');
                        }
                    });

                    // Mettre à jour le texte
                    const ratingText = document.getElementById('ratingText');
                    const texts = ['Très mauvais', 'Mauvais', 'Moyen', 'Bon', 'Excellent'];
                    ratingText.textContent = texts[value - 1];
                });
            });

            // Gérer l'affichage de la raison d'annulation
            document.getElementById('cancelReason').addEventListener('change', function() {
                const otherDiv = document.getElementById('otherReasonDiv');
                otherDiv.style.display = this.value === 'other' ? 'block' : 'none';
            });

            // Compteur de passagers pour la réservation
            document.getElementById('incrementPassengers').addEventListener('click', function() {
                const input = document.getElementById('passengerCount');
                let value = parseInt(input.value);
                if (value < 10) {
                    input.value = value + 1;
                }
            });

            document.getElementById('decrementPassengers').addEventListener('click', function() {
                const input = document.getElementById('passengerCount');
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            });

            // Remplir les modals avec les données du ticket
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.getAttribute('data-ticket-id');
                    const card = this.closest('.ticket-card');

                    if (!card) return;

                    // Extraire les données du ticket
                    const route = card.querySelector('h5').textContent.trim();
                    const badges = card.querySelectorAll('.badge.bg-light');
                    const bus = badges[0]?.textContent.replace('Bus', '').trim();
                    const seat = badges[1]?.textContent.replace('Siège', '').trim();
                    const price = badges[2]?.textContent.trim();
                    const status = card.querySelector('.badge-status').textContent.trim();

                    // Gérer chaque modal différemment
                    const targetModal = this.getAttribute('data-bs-target');

                    if (targetModal === '#rateModal') {
                        document.getElementById('rateTicketRoute').textContent = route;
                        document.getElementById('rateTicketId').textContent = ticketId;
                    } else if (targetModal === '#invoiceModal') {
                        document.getElementById('invoiceTicketId').textContent = ticketId;
                        document.getElementById('invoiceRoute').textContent = route;
                        document.getElementById('invoiceBus').textContent = bus;
                        document.getElementById('invoiceSeat').textContent = seat;
                        document.getElementById('invoicePrice').textContent = price;
                        document.getElementById('invoiceTotal').textContent = price;

                        // Générer des données fictives
                        const today = new Date();
                        document.getElementById('invoiceDate').textContent = today
                            .toLocaleDateString('fr-FR');
                        document.getElementById('invoiceNumber').textContent = ticketId;
                        document.getElementById('invoiceTripDate').textContent = '2024-11-14';
                        document.getElementById('invoiceTripTime').textContent = '22:00';
                    } else if (targetModal === '#viewModal') {
                        document.getElementById('viewTicketId').textContent = ticketId;

                        // Séparer départ et arrivée
                        const parts = route.split(' - ');
                        if (parts.length === 2) {
                            document.getElementById('viewDeparture').textContent = parts[0];
                            document.getElementById('viewArrival').textContent = parts[1];
                        }

                        document.getElementById('viewBusType').textContent = bus;
                        document.getElementById('viewSeatNumber').textContent = seat;
                        document.getElementById('viewTicketPrice').textContent = price;
                        document.getElementById('viewStatusBadge').textContent = status;

                        // Générer des heures fictives
                        document.getElementById('viewDepartureTime').textContent = '22:00 (départ)';
                        document.getElementById('viewArrivalTime').textContent = '06:00 (+1 jour)';
                        document.getElementById('viewDuration').textContent = '8h de trajet';

                        // Texte selon le statut
                        const statusMessages = {
                            'Confirmé': 'Votre réservation est confirmée. Présentez-vous 30min avant le départ.',
                            'À venir': 'Votre voyage est programmé. Préparez vos bagages !',
                            'Complété': 'Voyage terminé. Merci d\'avoir voyagé avec nous !'
                        };
                        document.getElementById('viewStatusMessage').textContent = statusMessages[
                            status] || '';

                        // Générer un QR code simple (simulation)
                        generateQRCode(ticketId);
                    } else if (targetModal === '#cancelModal') {
                        document.getElementById('cancelTicketId').textContent = ticketId;
                        document.getElementById('cancelTicketRoute').textContent = route;
                    } else if (targetModal === '#rebookModal') {
                        document.getElementById('rebookTicketRoute').textContent = route;
                        // Définir la date minimum à demain
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        document.getElementById('rebookDate').min = tomorrow.toISOString().split(
                            'T')[0];
                    }
                });
            });

            // Actions des boutons des modals
            document.getElementById('submitRating').addEventListener('click', function() {
                const rating = document.getElementById('ratingValue').value;
                if (rating === '0') {
                    alert('Veuillez donner une note avant de soumettre.');
                    return;
                }

                alert('Merci pour votre évaluation !');
                bootstrap.Modal.getInstance(document.getElementById('rateModal')).hide();
            });

            document.getElementById('confirmCancel').addEventListener('click', function() {
                const reason = document.getElementById('cancelReason').value;
                if (reason === '') {
                    alert('Veuillez sélectionner une raison d\'annulation.');
                    return;
                }

                alert('Votre annulation a été prise en compte. Vous recevrez un email de confirmation.');
                bootstrap.Modal.getInstance(document.getElementById('cancelModal')).hide();
            });

            document.getElementById('proceedRebook').addEventListener('click', function() {
                const date = document.getElementById('rebookDate').value;
                const passengers = document.getElementById('passengerCount').value;

                if (!date) {
                    alert('Veuillez sélectionner une date.');
                    return;
                }

                alert(`Recherche des disponibilités pour ${passengers} passager(s) le ${date}...`);
                bootstrap.Modal.getInstance(document.getElementById('rebookModal')).hide();
                // Ici, vous pourriez rediriger vers une page de recherche
                // window.location.href = `/search?date=${date}&passengers=${passengers}`;
            });

            // Fonction pour générer un QR code simple (simulation)
            function generateQRCode(ticketId) {
                const canvas = document.getElementById('qrCodeCanvas');
                const ctx = canvas.getContext('2d');

                // Effacer le canvas
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Dessiner un arrière-plan blanc
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                // Dessiner un motif simple (simulation de QR code)
                ctx.fillStyle = 'black';

                // Coins
                drawSquare(ctx, 10, 10, 30);
                drawSquare(ctx, canvas.width - 40, 10, 30);
                drawSquare(ctx, 10, canvas.height - 40, 30);

                // Texte au centre
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = '#198754';
                ctx.textAlign = 'center';
                ctx.fillText(ticketId, canvas.width / 2, canvas.height / 2);
            }

            function drawSquare(ctx, x, y, size) {
                ctx.fillRect(x, y, size, size);
                ctx.clearRect(x + 5, y + 5, size - 10, size - 10);
                ctx.fillRect(x + 10, y + 10, size - 20, size - 20);
            }

            // Initialiser un QR code par défaut
            generateQRCode('TICKET-ID');
        });
    </script>

    <style>
        .profile-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .ticket-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #198754;
        }

        .ticket-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .star-rating .star {
            cursor: pointer;
            margin: 0 5px;
            transition: all 0.2s;
        }

        .star-rating .star:hover {
            transform: scale(1.2);
        }

        .dashed-line {
            height: 2px;
            background: repeating-linear-gradient(to right,
                    #198754 0,
                    #198754 5px,
                    transparent 5px,
                    transparent 10px);
            position: relative;
        }

        .nav-link {
            transition: all 0.3s;
        }

        .nav-link:hover:not(.active) {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754 !important;
        }
    </style>

@endsection
