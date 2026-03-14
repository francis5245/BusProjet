@extends('layout.template')
@section('title', 'Accueil')
@section('contenu')
    <div>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">RÉSERVEZ VOTRE BILLET DE BUS</h1>
                <p class="hero-subtitle">Choisissez vos destinations et dates pour réserver un billet</p>
                <button class="btn-reserve">Réservez Maintenant</button>
            </div>
        </section>

        <!-- Search Form -->
        <section class="py-5">
            <div class="container">
                <form action="{{ route('recherche') }}" method="POST" id="search-form">
                    <div class="search-form">
                        <!-- From-To Section -->
                        <div class="from-to-group">
                            {{-- <input type="text" class="from-to-input" id="villeDepart" placeholder="Ville de départ"
                                list="cities"> --}}
                            <select name="villeDepart" id="villeDepart" class="from-to-input">
                                <option value="">Ville de départ</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                                @endforeach
                            </select>
                            <div class="swap-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            {{-- <input type="text" class="from-to-input" id="villeArrivee" placeholder="Ville de destination"
                                list="cities"> --}}
                            <select name="villeArrivee" id="villeArrivee" class="from-to-input">
                                <option value="">Ville de destination</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom_ville }}</option>
                                @endforeach
                            </select>
                            {{-- <datalist id="cities">
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->nom_ville }}"></option>
                                @endforeach
                                 <option value="Cox's Bazar"></option>
                                    <option value="Comilla"></option>
                                    <option value="Sylhet"></option>
                                    <option value="Chittagong"></option>  
                            </datalist> --}}
                        </div>

                        <!-- Departure Date -->
                        <div class="date-group">
                            <div class="date-label">Départ</div>
                            <div class="date-input">
                                <input type="date" class="date-field" id="dateDepart" name="dateDepart"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <!-- Return Date (Optional) -->
                        <div class="date-group">
                            <div class="date-label">Retour (Optionnel)</div>
                            <div class="date-input">
                                <input type="date" class="date-field" id="dateArrivee" name="dateArrivee"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <!-- Find Tickets Button -->
                        <button type="submit" class="find-tickets-btn">Trouver des Billets</button>
                    </div>
                </form>

            </div>
        </section>


        <!-- Steps Section -->
        <section class="py-5">
            <div class="container">
                <div class="section-title">
                    <h2>Achetez vos billets en trois étapes simples</h2>
                    <p>Réservez un voyage pas cher dans vos bus préférés</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="./asset/image/recherche.jpg" class="card-img-top" alt="Chercher un billet">
                            <div class="card-body">
                                <h5 class="card-title">Chercher un billet en ligne...</h5>
                                <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ...</p>
                                <a href="/work/4" class="btn-reserve">Ticket de recherche</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="./asset/image/select.jpg" class="card-img-top" alt="Choisir voyage">
                            <div class="card-body">
                                <h5 class="card-title">Choisissez votre voyage...</h5>
                                <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ...</p>
                                <a href="/work/5" class="btn-reserve">Sélection du voyage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="./asset/image/ticket.jpg" class="card-img-top" alt="Payer">
                            <div class="card-body">
                                <h5 class="card-title">Payez et obtenez une contravention...</h5>
                                <p>ad minim veniam, quis nostrud exerci adéquatement tation s...</p>
                                <a href="/work/6" class="btn-reserve">Payez et obtenez une contravention</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trips Section -->


        <div class="container travel-section">
            <h2 class="section-title">Profitez bien de vos voyages</h2>
            {{-- <p class="section-subtitle">Sélectionnez vos voyages pour voyager dans les endroits que vous souhaitez
                visiter</p> --}}

            <div class="trips-container" id="resultats">
                {{-- <div class="nav-arrow left" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </div> --}}
                <div class="nav-arrow left" id="prevBtn" style="display:none;">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div id="loader" style="display:none; text-align:center; padding:20px;">
                    <div class="spinner-border text-success" role="status"></div>
                    <p style="margin-top:10px;">Recherche en cours...</p>
                </div>
                <!-- Texte par défaut avant recherche -->
                <h3 id="defaultText" style="text-align:center; color:#666; font-size:16px;">
                    Entrez votre ville de départ, votre destination et la date pour trouver des voyages.
                </h3>
                <div id="resumeRecherche" style="margin-bottom:20px; font-weight:bold;"></div>
                <div class="trips-wrapper" id="tripsWrapper"></div>

                {{-- <div class="trips-wrapper" id="tripsWrapper">
                    <!-- Trip 1 -->
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="./asset/image/bus12.jpg" alt="Cox's Bazar - Rangpur">
                        </div>
                        <div class="trip-info">
                            <div class="trip-route">COX'S BAZAR - RANGPUR</div>

                            <!-- Horaires et sièges sur la même ligne -->
                            <div
                                style="display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; color: #666;">
                                <span><i class="fas fa-clock" style="color: #01602A;"></i> 08:00 - 16:30</span>
                                <span><i class="fas fa-chair" style="color: #01602A;"></i> 24 sièges</span>
                            </div>

                            <div class="trip-price">
                                <span class="price-label">Prix : BDT 700</span>
                                <button class="reserve-btn">Réservez Maintenant</button>
                            </div>
                        </div>
                    </div>


                    <!-- Trip 2 -->
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="./asset/image/bus13.jpg" alt="Dhaka - Rangpur">
                        </div>
                        <div class="trip-info">
                            <div class="trip-route">DHAKA - RANGPUR</div>

                            <!-- Horaires et sièges sur la même ligne -->
                            <div
                                style="display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; color: #666;">
                                <span><i class="fas fa-clock" style="color: #01602A;"></i> 06:00 - 14:30</span>
                                <span><i class="fas fa-chair" style="color: #01602A;"></i> 32 sièges</span>
                            </div>

                            <div class="trip-price">
                                <span class="price-label">Prix : BDT 800</span>
                                <button class="reserve-btn">Réservez Maintenant</button>
                            </div>
                        </div>
                    </div>

                    <!-- Trip 3 -->
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="./asset/image/bus14.jpg" alt="Rangpur - Comilla">
                        </div>
                        <div class="trip-info">
                            <div class="trip-route">RANGPUR - COMILLA</div>

                            <!-- Horaires et sièges sur la même ligne -->
                            <div
                                style="display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; color: #666;">
                                <span><i class="fas fa-clock" style="color: #01602A;"></i> 09:00 - 18:00</span>
                                <span><i class="fas fa-chair" style="color: #01602A;"></i> 28 sièges</span>
                            </div>

                            <div class="trip-price">
                                <span class="price-label">Prix : BDT 1200</span>
                                <button class="reserve-btn">Réservez Maintenant</button>
                            </div>
                        </div>
                    </div>

                    <!-- Trip 4 -->
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="./asset/image/bus15.jpg" alt="Comilla - Rangpur">
                        </div>
                        <div class="trip-info">
                            <div class="trip-route">COMILLA - RANGPUR</div>

                            <!-- Horaires et sièges sur la même ligne -->
                            <div
                                style="display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; color: #666;">
                                <span><i class="fas fa-clock" style="color: #01602A;"></i> 10:00 - 19:00</span>
                                <span><i class="fas fa-chair" style="color: #01602A;"></i> 28 sièges</span>
                            </div>

                            <div class="trip-price">
                                <span class="price-label">Prix : BDT 1300</span>
                                <button class="reserve-btn">Réservez Maintenant</button>
                            </div>
                        </div>
                    </div>

                    <!-- Trip 5 (duplicate for infinite scroll effect) -->
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="./asset/image/bus16.jpg" alt="Cox's Bazar - Rangpur">
                        </div>
                        <div class="trip-info">
                            <div class="trip-route">COX'S BAZAR - RANGPUR</div>

                            <!-- Horaires et sièges sur la même ligne -->
                            <div
                                style="display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; color: #666;">
                                <span><i class="fas fa-clock" style="color: #01602A;"></i> 08:00 - 16:30</span>
                                <span><i class="fas fa-chair" style="color: #01602A;"></i> 24 sièges</span>
                            </div>

                            <div class="trip-price">
                                <span class="price-label">Prix : BDT 700</span>
                                <button class="reserve-btn">Réservez Maintenant</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="nav-arrow right" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </div> --}}
                <div class="nav-arrow right" id="nextBtn" style="display:none;">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>



        <!-- Customer Feedback Section -->


        <div class="container feedback-section">
            <h2 class="section-title">Customer Feedback</h2>
            <p class="section-subtitle">Read what our customers have to say about our fleet and services.</p>

            <div class="row g-4">
                <!-- Feedback Card 1 -->
                <div class="col-md-4">
                    <div class="feedback-card">
                        <div>
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="feedback-text">
                                A good bus service is essential for efficient public transportation, contributing to
                                the
                                overall convenience and quality of life in a community. Re...
                            </p>
                        </div>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Kamala Hariss">
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Kamala Hariss</div>
                                <div class="customer-title">Amazing Bus</div>
                            </div>
                            <button class="read-more-btn">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Feedback Card 2 -->
                <div class="col-md-4">
                    <div class="feedback-card">
                        <div>
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="feedback-text">
                                A good bus service is essential for efficient public transportation, contributing to
                                the
                                overall convenience and quality of life in a community. Re...
                            </p>
                        </div>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Masudur Rahman">
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Masudur Rahman</div>
                                <div class="customer-title">What a wonderful trip</div>
                            </div>
                            <button class="read-more-btn">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Feedback Card 3 -->
                <div class="col-md-4">
                    <div class="feedback-card">
                        <div>
                            <div class="quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="feedback-text">
                                A good bus service is essential for efficient public transportation, contributing to
                                the
                                overall convenience and quality of life in a community. Re...
                            </p>
                        </div>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Joe Biden">
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Joe Biden</div>
                                <div class="customer-title">Very good service</div>
                            </div>
                            <button class="read-more-btn">Read More</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="pagination-dots">
                <div class="dot active"></div>
                <div class="dot"></div>
            </div>
        </div>




        <!-- App Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Tirez plus parti de Bus365 avec notre application mobile</h2>
                        <p>Avec l’application mobile, vous pouvez désormais acheter vos billets avec l’aide de votre
                            téléphone depuis n’importe où dans le monde. L’application offre de la flexibilité,
                            permettant aux voyageurs d’obtenir des billets en déplacement, de choisir des places
                            préférées, de ne pas charger les factures.</p>
                        <ul>
                            <li>Excellent design UI/UX</li>
                            <li>Accès facile à toutes les fonctionnalités</li>
                            <li>Le paiement est facile avec plusieurs passerelles</li>
                            <li>Télécharger les billets/facture</li>
                        </ul>
                        <div class="mt-3">
                            <a href="https://www.apple.com/app-store/" target="_blank" class="me-2">
                                <img src="./asset/image/App store.png" alt="App Store">
                            </a>
                            <a href="https://play.google.com/store?hl=en_US&gl=US" target="_blank">
                                <img src="./asset/image/Google play.png" alt="Google Play">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="./asset/image/mobile.png" alt="Application mobile" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Section -->


        <div class="container blog-section">
            <h2 class="section-title">Blog de voyage</h2>
            <p class="section-subtitle">Lisez les billets de voyage de nos différents auteurs et les commentaires
                authentiques</p>

            <div class="row g-4">
                <!-- Article 1 -->
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="./asset/image/mexique.jpg" alt="Mexico">
                        </div>
                        <div class="blog-content">
                            <div>
                                <h3 class="blog-title">Pourquoi Mexico est-elle un bon endroit à visiter...</h3>
                                <p class="blog-excerpt">
                                    Ut wisi enim ad minim veniam, quis nostrud exercitation augmentation des chances
                                    pour autant qu'elles soient susceptibles de nous rendre compte tenu d'une
                                    autre...
                                </p>
                            </div>
                            <button class="read-more-btn">Lire la suite</button>
                        </div>
                    </div>
                </div>

                <!-- Article 2 -->
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="./asset/image/thailand.jpg" alt="Thailande">
                        </div>
                        <div class="blog-content">
                            <div>
                                <h3 class="blog-title">Explorer des îles magiques en Thaïlande...</h3>
                                <p class="blog-excerpt">
                                    consectetur adipiscing elit, sed diam nonummy selon lequel il a vu le dolore
                                    difficile ali...
                                </p>
                            </div>
                            <button class="read-more-btn">Lire la suite</button>
                        </div>
                    </div>
                </div>

                <!-- Article 3 -->
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="./asset/image/mexique.jpg" alt="Alpes">
                        </div>
                        <div class="blog-content">
                            <div>
                                <h3 class="blog-title">À quoi s'attendre des Alpes vibrantes...</h3>
                                <p class="blog-excerpt">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nuev.
                                </p>
                            </div>
                            <button class="read-more-btn">Lire la suite</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Newsletter Section -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ne Manquez Jamais Une Offre</title>



        <div class="newsletter-section">
            <div class="overlay"></div>
            <div class="newsletter-content">
                <h2 class="newsletter-title">Ne Manquez Jamais Une Offre</h2>
                <p class="newsletter-subtitle">Abonnez-vous et soyez le premier à recevoir nos offres exclusives
                </p>
                <form class="newsletter-form">
                    <input type="email" class="email-input" placeholder="Adresse e-mail" required>
                    <button type="submit" class="subscribe-btn">S'inscrire</button>
                </form>
            </div>
        </div>


    </div>
    
@endsection
