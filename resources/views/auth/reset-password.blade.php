<x-guest-layout>
    @section('title', 'Réinitialiser le mot de passe')

    @section('contenu')
        <!-- Main Content -->
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Réinitialiser le mot de passe - BUS365</title>
            <!-- Bootstrap 5 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <style>
                .reset-container {
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

                h2 {
                    font-weight: bold;
                    color: #333;
                    margin-bottom: 10px;
                }

                p {
                    color: #6c757d;
                    margin-bottom: 25px;
                    line-height: 1.6;
                }

                .form-control {
                    padding: 10px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    font-size: 14px;
                }

                .input-group-text {
                    background: transparent;
                    border: none;
                    color: #6c757d;
                    padding: 0 10px;
                }

                .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                    cursor: pointer;
                    color: #6c757d;
                    font-size: 16px;
                }

                .btn-update {
                    background-color: #079d49;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 6px;
                    font-weight: bold;
                    width: 100%;
                    margin-top: 10px;
                    transition: background-color 0.2s;
                }

                .btn-update:hover {
                    background-color: #05853c;
                }

                .message-success {
                    color: #28a745;
                    font-weight: 500;
                    margin-top: 15px;
                    display: none;
                }
            </style>
        </head>

        <body>
            <div class="reset-container">
                <!-- Logo Bar -->
                <div class="logo-bar">
                    <span class="logo-text">BUS365</span>
                    <i class="fas fa-bus-alt logo-icon"></i>
                </div>

                <!-- Title -->
                <h2>Réinitialiser votre mot de passe</h2>

                <!-- Expiration Notice -->
                <p>Le lien que vous avez reçu expire dans <strong>60 minutes</strong>. Veuillez saisir un nouveau mot de
                    passe ci-dessous.</p>

                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.update') }}">

                    @csrf

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    {{-- Nouveau mot de passe --}}
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Nouveau mot de passe" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirmation --}}
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirmer le mot de passe" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-update">
                        Mettre à jour le mot de passe
                    </button>
                </form>


                <!-- Success Message -->
                <div id="successMessage" class="message-success">
                    Votre mot de passe a été mis à jour avec succès.
                </div>
            </div>

            <!-- Bootstrap JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // Toggle password visibility
                function setupToggle(id) {
                    const toggle = document.getElementById(id);
                    const input = document.getElementById(id === 'toggleNewPassword' ? 'newPassword' : 'confirmPassword');
                    toggle.addEventListener('click', () => {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        const icon = toggle.querySelector('i');
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    });
                }

                setupToggle('toggleNewPassword');
                setupToggle('toggleConfirmPassword');

                // Form submission
                document.getElementById('resetForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;

                    if (newPassword !== confirmPassword) {
                        alert('Les mots de passe ne correspondent pas.');
                        return;
                    }

                    if (newPassword.length < 6) {
                        alert('Le mot de passe doit contenir au moins 6 caractères.');
                        return;
                    }

                    // Simuler la mise à jour
                    document.getElementById('successMessage').style.display = 'block';
                    this.reset();

                    // Optionnel : redirection après 2 secondes
                    // setTimeout(() => {
                    //     window.location.href = 'login.html';
                    // }, 2000);
                });
            </script>
        </body>

        </html>
    @endsection


</x-guest-layout>
