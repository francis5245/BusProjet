<x-guest-layout>
    @section('title', 'Réinitialiser le mot de passe')

    @section('contenu')
        <!-- Main Content -->
        <div class="forgot-container">
            <!-- Logo Bar -->
            <div class="logo-bar">
                <span class="logo-text">BUS365</span>
                <i class="fas fa-bus-alt logo-icon"></i>
            </div>

            <!-- Title -->
            <h5 class="forgot-title">Tu As Oublié Le Mot De Passe ?</h5>

            <!-- Instructions -->
            <p class="forgot-text">
                Veuillez entrer votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


            <!-- Email Input -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Votre adresse email" value="{{ old('email') }}"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="postulez-btn">Postulez</button>
            </form>
            <a href="{{ route('login') }}" class="back-link">Retour à la connexion</a>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 5000); // Le message disparaît après 5 secondes
                }
            });
        </script>
    @endsection

</x-guest-layout>
