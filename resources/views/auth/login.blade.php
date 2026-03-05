<x-guest-layout>
    @section('title', 'Connexion')
    @section('contenu')
        <div class="login-container">
            <h5 class="login-title">Se connecter</h5>

            <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Message d'erreur global -->
                <div id="globalError" class="text-danger text-center d-none">
                    Email ou mot de passe incorrect
                </div>

                <!-- Email -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Adresse e-mail"
                        required>
                </div>

                <!-- Mot de passe -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*******"
                        required>
                    <span class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>

                <button type="submit" class="sign-in-btn">Se connecter</button>

                <div class="signup-link">
                    Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a>
                </div>
            </form>

            <script>
                // Basculer la visibilité du mot de passe
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');

                togglePassword.addEventListener('click', function(e) {
                    // Basculer l'attribut type
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // Basculer l'icône oeil / oeil barré
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const form = document.getElementById('loginForm');
                    const globalError = document.getElementById('globalError');
                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password');

                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // ⛔ empêche le reload

                        globalError.classList.add('d-none');

                        const formData = new FormData(form);

                        fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json', // 🔑 IMPORTANT
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                },
                                body: formData
                            })
                            .then(async response => {
                                if (!response.ok) {
                                    throw await response.json();
                                }
                                return response.json();
                            })
                            .then(data => {
                                // ✅ Login réussi → redirection
                                window.location.href = '/dashboard';
                            })
                            .catch(error => {
                                // ❌ QUELLE QUE SOIT L'ERREUR
                                globalError.classList.remove('d-none');
                                globalError.textContent = 'Email ou mot de passe incorrect';

                                passwordInput.value = '';
                            });
                    });

                });
            </script>

        </div>
    @endsection
</x-guest-layout>
