<x-guest-layout>
    @section('title', 'Inscription')

    @section('contenu')
        <style>
            .verify-container {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                width: 100%;
                max-width: 500px;
                text-align: center;
                margin: 50px auto;
            }

            .logo-bar {
                background-color: #079d49;
                padding: 15px 0;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin: -40px -40px 30px -40px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .logo-text {
                color: white;
                font-weight: bold;
                font-size: 24px;
                margin-right: 10px;
            }

            .logo-icon {
                color: white;
                font-size: 24px;
            }

            .check-icon {
                font-size: 60px;
                color: #28a745;
                margin-bottom: 20px;
            }

            h2 {
                font-weight: bold;
                color: #333;
                margin-bottom: 15px;
            }

            p {
                color: #6c757d;
                margin-bottom: 25px;
                line-height: 1.6;
            }

            .btn-resend {
                background-color: #079d49;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 6px;
                font-weight: bold;
                transition: background-color 0.2s;
                margin-bottom: 15px;
            }

            .btn-resend:hover {
                background-color: #05853c;
            }

            .profile-link {
                display: inline-block;
                color: #079d49;
                text-decoration: none;
                font-weight: 500;
                margin-top: 10px;
            }

            .profile-link:hover {
                text-decoration: underline;
            }

            .spinner {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, .3);
                border-radius: 50%;
                border-top-color: #fff;
                animation: spin 1s ease-in-out infinite;
                margin-right: 8px;
                vertical-align: middle;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            .message-success {
                color: #28a745;
                font-weight: 500;
                margin-top: 15px;
                display: none;
            }
        </style>
        <div class="verify-container">
            <!-- Logo Bar -->
            <div class="logo-bar">
                <span class="logo-text">BUS365</span>
                <i class="fas fa-bus-alt logo-icon"></i>
            </div>

            <!-- Check Icon -->
            <div class="check-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <!-- Title -->
            <h2>Merci de vous être inscrit !</h2>

            <!-- Instructions -->
            <p>
                Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de
                vous envoyer par e-mail ?
            </p>

            <!-- Resend Button -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button id="resendBtn" class="btn-resend">
                    <span id="btnText">Renvoyer l’e-mail de vérification</span>
                </button>
            </form>


            <!-- Lien "Modifier le profil" -->
            <a href="{{ route('profile.show') }}" class="profile-link">Modifier le profil</a>

            <!-- Success Message -->
            <div id="successMessage" class="message-success">
                Un nouvel e-mail de vérification a été envoyé.
            </div>
        </div>
        <script>
            document.getElementById('resendBtn').addEventListener('click', function(e) {
                e.preventDefault(); // Empêche la soumission classique
                const btn = this;
                const successMessage = document.getElementById('successMessage');

                btn.disabled = true;
                btn.innerHTML = '<span class="spinner"></span> Envoi en cours...';

                fetch("{{ route('verification.send') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            successMessage.style.display = 'block';
                            setTimeout(() => successMessage.style.display = 'none', 5000);
                        }
                        btn.disabled = false;
                        btn.innerHTML = 'Renvoyer l’e-mail de vérification';
                    })
                    .catch(error => {
                        console.error(error);
                        btn.disabled = false;
                        btn.innerHTML = 'Renvoyer l’e-mail de vérification';
                    });
            });
        </script>
    @endsection
</x-guest-layout>
