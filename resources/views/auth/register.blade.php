<x-guest-layout>
    @section('title', 'Inscription')
    @section('contenu')
        <div class="signup-container">
            <!-- Logo Bar -->
            <div class="logo-bar">
                <span class="logo-text">BUS365</span>
                <i class="fas fa-bus-alt logo-icon"></i>
            </div>

            <!-- Title -->
            <h5 class="signup-title">Créer un compte</h5>

            <!-- Sign Up Form -->
            <form id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom complet">
                    </div>
                    <small class="text-danger text-center" id="nameError"></small>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Adresse e-mail">
                    </div>
                    <small class="text-danger text-center" id="emailError"></small>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="+22901XXXXXX">
                    </div>
                    <small class="text-danger text-center" id="phoneError"></small>
                </div>

                <div class="mb-3 position-relative">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Mot de passe">
                        <span class="toggle-password" id="togglePassword"><i class="fas fa-eye"></i></span>
                    </div>
                    <small class="text-danger text-center" id="passwordError"></small>

                    <!-- Liste des règles (cachée par défaut) et centrée -->
                    <ul id="passwordRules"
                        style="list-style:none; padding-left:0; margin-top:5px; display:none; text-align:center;">
                        <li id="ruleLength" style="color:red">8 caractères minimum</li>
                        <li id="ruleUpper" style="color:red">Au moins une majuscule</li>
                        <li id="ruleSymbol" style="color:red">Au moins un symbole (!@#$%^&*)</li>
                    </ul>
                </div>

                <div class="mb-3 position-relative">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                            placeholder="Confirmer le mot de passe">
                        <span class="toggle-password" id="toggleConfirmPassword"><i class="fas fa-eye"></i></span>
                    </div>
                    <small class="text-danger text-center" id="confirmPasswordError"></small>
                </div>

                <button type="submit" class="signup-btn">S'inscrire</button>
            </form>


            <!-- Login Link -->
            <div class="login-link">
                Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous</a>
            </div>
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Toggle password visibility
            function setupToggle(id) {
                const toggle = document.getElementById(id);
                const input = document.getElementById(id === 'togglePassword' ? 'password' : 'confirmPassword');
                toggle.addEventListener('click', () => {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    const icon = toggle.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }

            setupToggle('togglePassword');
            setupToggle('toggleConfirmPassword');

            // Form validation
            document.getElementById('signupForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;

                if (password !== confirmPassword) {
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }

                if (password.length < 6) {
                    alert('Le mot de passe doit contenir au moins 6 caractères.');
                    return;
                }

                // Simuler l'inscription
                alert('Inscription réussie ! Redirection vers la page de connexion...');
                // window.location.href = 'login.html'; // Décommentez pour redirection réelle
            });
        </script>
        {{-- <script>
            // --- Récupération des éléments ---
            const form = document.getElementById('registerForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');

            // Messages d'erreur
            const errors = {
                name: document.getElementById('nameError'),
                email: document.getElementById('emailError'),
                phone: document.getElementById('phoneError'),
                password: document.getElementById('passwordError'),
                confirmPassword: document.getElementById('confirmPasswordError')
            };

            // Règles mot de passe
            const passwordRules = document.getElementById('passwordRules');
            const ruleLength = document.getElementById('ruleLength');
            const ruleUpper = document.getElementById('ruleUpper');
            const ruleSymbol = document.getElementById('ruleSymbol');

            // --- Affichage / disparition règles mot de passe ---
            passwordInput.addEventListener('focus', function() {
                passwordRules.style.display = 'block';
            });
            passwordInput.addEventListener('blur', function() {
                passwordRules.style.display = 'none';
            });

            // --- Validation en direct des règles mot de passe ---
            passwordInput.addEventListener('input', function() {
                const value = passwordInput.value;
                ruleLength.style.color = value.length >= 8 ? 'green' : 'red';
                ruleUpper.style.color = /[A-Z]/.test(value) ? 'green' : 'red';
                ruleSymbol.style.color = /[!@#$%^&*]/.test(value) ? 'green' : 'red';

                if (errors.password.textContent) errors.password.textContent = '';
            });

            // --- Supprimer les messages d'erreur dès qu'on écrit dans les autres champs ---
            [nameInput, emailInput, phoneInput, confirmPasswordInput].forEach(input => {
                input.addEventListener('input', function() {
                    const id = input.id;
                    if (errors[id].textContent) errors[id].textContent = '';
                });
            });

            // --- Validation du formulaire au submit ---
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Empêche le rechargement

                let hasError = false;

                // Réinitialiser toutes les erreurs
                Object.values(errors).forEach(el => el.textContent = '');

                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const phone = phoneInput.value.trim();
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // --- VALIDATION NAME ---
                const nameParts = name.split(' ').filter(part => part.length > 0);
                if (!name) {
                    errors.name.textContent = "Le nom est requis";
                    hasError = true;
                } else if (nameParts.length < 5) {
                    errors.name.textContent = "Le nom complet doit contenir au moins 5 mots";
                    hasError = true;
                } else if (name.length > 255) {
                    errors.name.textContent = "Le nom ne peut pas dépasser 255 caractères";
                    hasError = true;
                }

                // --- VALIDATION EMAIL ---
                if (!email) {
                    errors.email.textContent = "L’email est requis";
                    hasError = true;
                } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                    errors.email.textContent = "Format d’email invalide";
                    hasError = true;
                }

                // --- VALIDATION PHONE (Bénin) ---
                // Les numéros béninois commencent par 9, 6 ou 5 et font 8 chiffres après l'indicatif
                if (phone && !/^(?:\+229)?[956]\d{7}$/.test(phone)) {
                    errors.phone.textContent = "Numéro de téléphone béninois invalide";
                    hasError = true;
                }

                // --- VALIDATION PASSWORD ---
                if (!password) {
                    errors.password.textContent = "Mot de passe requis";
                    hasError = true;
                } else if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*]/.test(password)) {
                    errors.password.textContent = "Le mot de passe doit respecter toutes les règles";
                    hasError = true;
                }

                // --- VALIDATION CONFIRM PASSWORD ---
                if (password !== confirmPassword) {
                    errors.confirmPassword.textContent = "Les mots de passe ne correspondent pas";
                    hasError = true;
                }

                // --- ENVOI AJAX SI PAS D'ERREUR ---
                if (!hasError) {
                    sendFormAjax();
                }
            });

            // --- FONCTION AJAX ---
            async function sendFormAjax() {
                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('register') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            // Affiche les erreurs serveur sous chaque champ
                            for (const key in data.errors) {
                                const el = errors[key];
                                if (el) {
                                    // Cas email déjà utilisé
                                    if (key === 'email' && data.errors[key][0].includes('already')) {
                                        el.textContent = "Cet email est déjà utilisé";
                                    } else {
                                        el.textContent = data.errors[key][0];
                                    }
                                }
                            }
                        } else {
                            alert('Erreur lors de l’inscription');
                        }
                    } else {
                        // Succès : redirection vers dashboard
                        window.location.href = "/dashboard";
                    }

                } catch (err) {
                    console.error(err);
                    alert('Erreur réseau');
                }
            }
        </script> --}}
        <script>
            // --- Récupération des éléments ---
            const form = document.getElementById('registerForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');

            // Messages d'erreur
            const errors = {
                name: document.getElementById('nameError'),
                email: document.getElementById('emailError'),
                phone: document.getElementById('phoneError'),
                password: document.getElementById('passwordError'),
                confirmPassword: document.getElementById('confirmPasswordError')
            };

            // Règles mot de passe
            const passwordRules = document.getElementById('passwordRules');
            const ruleLength = document.getElementById('ruleLength');
            const ruleUpper = document.getElementById('ruleUpper');
            const ruleSymbol = document.getElementById('ruleSymbol');

            // --- Affichage / disparition règles mot de passe ---
            passwordInput.addEventListener('focus', function() {
                passwordRules.style.display = 'block';
            });

            passwordInput.addEventListener('blur', function() {
                // Petit délai pour permettre le clic sur les messages
                setTimeout(() => {
                    passwordRules.style.display = 'none';
                }, 200);
            });

            // --- Validation en direct des règles mot de passe ---
            passwordInput.addEventListener('input', function() {
                const value = passwordInput.value;
                ruleLength.style.color = value.length >= 8 ? 'green' : 'red';
                ruleUpper.style.color = /[A-Z]/.test(value) ? 'green' : 'red';
                ruleSymbol.style.color = /[!@#$%^&*]/.test(value) ? 'green' : 'red';

                if (errors.password.textContent) errors.password.textContent = '';
            });

            // --- Supprimer les messages d'erreur dès qu'on écrit dans les autres champs ---
            const inputs = {
                name: nameInput,
                email: emailInput,
                phone: phoneInput,
                confirmPassword: confirmPasswordInput
            };

            Object.keys(inputs).forEach(key => {
                inputs[key].addEventListener('input', function() {
                    if (errors[key] && errors[key].textContent) {
                        errors[key].textContent = '';
                    }
                });
            });

            // --- Validation du formulaire au submit ---
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Empêche le rechargement

                let hasError = false;

                // Réinitialiser toutes les erreurs
                Object.values(errors).forEach(el => {
                    if (el) el.textContent = '';
                });

                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const phone = phoneInput.value.trim();
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // --- VALIDATION NAME ---
                if (!name) {
                    errors.name.textContent = "Le nom est requis";
                    hasError = true;
                } else if (name.length < 5) {
                    errors.name.textContent = "Le nom doit contenir au moins 5 caractères";
                    hasError = true;
                } else if (name.length > 100) {
                    errors.name.textContent = "Le nom ne peut pas dépasser 100 caractères";
                    hasError = true;
                }

                // --- VALIDATION EMAIL ---
                if (!email) {
                    errors.email.textContent = "L'email est requis";
                    hasError = true;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    errors.email.textContent = "Format d'email invalide";
                    hasError = true;
                }

                // --- VALIDATION PHONE (Bénin) ---
                if (!phone) {
                     errors.phone.textContent = "Le numéro de téléphone est requis";
                    hasError = true;}else {
                    // Nettoyer le numéro (supprimer espaces, tirets)
                    const cleanPhone = phone.replace(/[\s\-]/g, '');

                    // Format accepté : +22901XXXXXX ou 01XXXXXX (doit commencer par 01 suivi de 9,5,6 ou 4)
                    if (!/^(\+229|0)?01[9564]\d{7}$/.test(cleanPhone)) {
                        errors.phone.textContent = "Numéro invalide (essayer +22901XXXXXX)";
                        hasError = true;
                    }
                    

                }

                // --- VALIDATION PASSWORD ---
                if (!password) {
                    errors.password.textContent = "Mot de passe requis";
                    hasError = true;
                } else if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*]/.test(password)) {
                    errors.password.textContent = "Le mot de passe doit respecter toutes les règles";
                    hasError = true;
                }

                // --- VALIDATION CONFIRM PASSWORD ---
                if (!confirmPassword) {
                    errors.confirmPassword.textContent = "Veuillez confirmer le mot de passe";
                    hasError = true;
                } else if (password !== confirmPassword) {
                    errors.confirmPassword.textContent = "Les mots de passe ne correspondent pas";
                    hasError = true;
                }

                // --- ENVOI AJAX SI PAS D'ERREUR ---
                if (!hasError) {
                    sendFormAjax();
                }
            });

            // --- FONCTION AJAX ---
            async function sendFormAjax() {
                // Afficher un indicateur de chargement
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = "Inscription en cours...";
                submitBtn.disabled = true;

                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('register') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            // Affiche les erreurs serveur sous chaque champ
                            for (const key in data.errors) {
                                const el = errors[key];
                                if (el) {
                                    el.textContent = data.errors[key][0];
                                } else {
                                    // Pour les champs sans élément d'erreur spécifique
                                    console.error(`Erreur pour ${key}:`, data.errors[key][0]);
                                }
                            }
                        } else {
                            alert('Erreur lors de l\'inscription: ' + (data.message || 'Erreur inconnue'));
                        }
                    } else {
                        // Succès
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.href = "/dashboard";
                        }
                    }

                } catch (err) {
                    console.error(err);
                    alert('Erreur réseau ou serveur indisponible');
                } finally {
                    // Réactiver le bouton
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            }
        </script>




    @endsection
</x-guest-layout>
