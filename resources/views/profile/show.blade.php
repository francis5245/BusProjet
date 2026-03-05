<x-app-layout>
    <!-- HEADER -->
    <div class="profile-header">
        <div class="container">
            <h2>Profil</h2>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="profile-container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- PROFILE INFO -->
        <div class="profile-grid">
            <div class="profile-info">
                <h3>Informations du profil</h3>
                <p>Modifiez votre nom et votre email.</p>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="profile-card">
                    <div class="profile-card-body">
                        <label class="profile-label">Nom</label>
                        <input class="profile-input" type="text" placeholder="Votre nom" name="name"
                            value="{{ Auth::user()->name }}" required>
                        <label class="profile-label">Email</label>
                        <input class="profile-input" type="email" placeholder="email@example.com" name="email"
                            value="{{ Auth::user()->email }}" required>

                        <p class="email-warning">
                            Votre email n’est pas vérifié.

                            <button id="resendBtn" type="button" class="btn-resend">
                                <span id="btnText">Renvoyer l’e-mail de vérification</span>
                            </button>
                            <span id="successMessage" class="success-message"
                                style="display:none; margin-left:0.5rem;">E-mail de vérification envoyé.</span>

                        </p>
                    </div>
                    <div class="profile-card-footer">
                        <button type="submit" class="btn-profile">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="profile-separator"></div>

        <!-- PASSWORD -->
        <div class="profile-grid">
            <div class="profile-info">
                <h3>Mot de passe</h3>
                <p>Utilisez un mot de passe sécurisé.</p>
            </div>
            <form method="POST" action="{{ route('profile.updatePassword') }}">
                @csrf
                @method('PUT')
                <div class="profile-card">
                    <div class="profile-card-body">
                        <label class="profile-label">Mot de passe actuel</label>
                        <input class="profile-input" type="password" name="current_password" required>

                        <label class="profile-label">Nouveau mot de passe</label>
                        <input class="profile-input" type="password" name="password" required>

                        <label class="profile-label">Confirmer le mot de passe</label>
                        <input class="profile-input" type="password" name="password_confirmation" required>
                    </div>
                    <div class="profile-card-footer">
                        <button class="btn-profile">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    {{-- <script>
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
    </script> --}}
</x-app-layout>
