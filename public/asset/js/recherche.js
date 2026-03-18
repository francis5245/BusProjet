document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("search-form");
    const resultContainer = document.getElementById("tripsWrapper");
    const loader = document.getElementById("loader");
    //Nouvelles références pour le basculement de la page
    const sectionAccueil = document.getElementById("section-accueil");
    const sectionResultats = document.getElementById('section-resultats')
    if (form) {
        form.addEventListener("submit", function (e) {

            e.preventDefault(); // Empêche le rechargement
            //recuperation des champs
            const departId = document.getElementById("villeDepart").value;
            const arriveeId = document.getElementById("villeArrivee").value;
            const dateDepart = document.getElementById("dateDepart").value;

            // Vérification des champs
            if (!departId || !arriveeId || !dateDepart) {
                showNotification("Veuillez remplir tous les champs !", "danger");
                // showNotification("Enregistré !", "success");
                // showNotification("Attention au quota !", "warning");
                return; // stop la recherche
            }
            // empêcher que l'utilisateur choisisse la même ville pour départ et arrivée.
            if (departId === arriveeId) {

                showNotification("La ville de départ et d'arrivée doivent être différentes.", "warning");
                return;
            }
            // afficher loader
            loader.style.display = "block";
            resultContainer.innerHTML = "";
            //Appel AJAX
            fetch(form.action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    villeDepart: departId,
                    villeArrivee: arriveeId,
                    dateDepart: dateDepart
                })
            })

                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erreur réseau");
                    }
                    return response.json();
                })

                .then(data => {

                    loader.style.display = "none";

                    if (!data.success) {
                        resultContainer.innerHTML = "";
                        // Swal.fire({
                        //     icon: "info",
                        //     title: "Information",
                        //     text: data.message, // message venant du serveur
                        //     width: "300px"
                        // });
                        showNotification(data.message, "danger");
                        return;
                    }

                    // afficherResultats(data.voyages); // affichage des résultats de recherche

                    //---STRATEGIE DE CHAGEMENT DE "PAGE"--
                    const params = '?from=${departId}&to=${arriveeId}$date=${dateDepart}';
                    window.history.pushState(
                        { view: 'results' },
                        "Résultats",
                        `/resultats?token=${data.token}`
                    );
                    
                    // //Basculement visuel
                    // sectionAccueil.style.display = "none";
                    // sectionResultats.style.display = "block";

                    // Le nombre de voyage disponible
                    const nombreVoyages = data.voyages.length;

                    const premierVoyage = data.voyages[0];

                    const depart = premierVoyage.trajet.ville_depart.nom_ville;
                    const arrivee = premierVoyage.trajet.ville_arrivee.nom_ville;
                    const date = premierVoyage.date_depart;

                    document.getElementById("resumeRecherche").innerHTML =
                        `Vous avez <b>${nombreVoyages}</b> voyage(s) disponible(s) de <b>${depart}</b> à <b>${arrivee}</b> le <b>${date}</b>.`;

                    //  scroll vers les résultats de recherche
                    document.getElementById("resultats").scrollIntoView({
                        behavior: "smooth"
                    });
                    //button next
                    // prevBtn.style.display = "flex";
                    // nextBtn.style.display = "flex";

                })

                .catch(error => {

                    loader.style.display = "none";

                    console.error(error);

                    // Swal.fire({
                    //     icon: "error",
                    //     title: "Erreur",
                    //     text: "Une erreur est survenue pendant la recherche",
                    //     width: "300px"
                    // });
                    showNotification("Une erreur est survenue pendant la recherche", "danger");

                });

        });
    }

})
function afficherResultats(voyages) {

    let html = "";

    voyages.forEach((voyage, index) => {

        html += `
        <div class="trip-card fade-card" style="animation-delay:${index * 0.1}s">

            <div class="trip-image">
               <img src="/storage/${voyage.bus.image}">
            </div>

            <div class="trip-info">

                <div class="trip-route">
                    ${voyage.trajet.ville_depart.nom_ville} - ${voyage.trajet.ville_arrivee.nom_ville}
                </div>

                <div style="display:flex; justify-content:space-between; margin:8px 0; font-size:14px; color:#666;">

                    <span>
                        <i class="fas fa-clock" style="color:#01602A;"></i>
                        ${voyage.heure_depart} - ${voyage.heure_arrivee}
                    </span>

                    <span>
                        <i class="fas fa-chair" style="color:#01602A;"></i>
                        ${voyage.places_disponibles} sièges
                    </span>

                </div>

                <div class="trip-price">

                    <span class="price-label">
                        Prix : ${voyage.prix} FCFA
                    </span>

                    <button class="reserve-btn">
                        Réservez Maintenant
                    </button>

                </div>

            </div>

        </div>
        `;

    });

    resultContainer.innerHTML = html;

}


function showNotification(message, type = 'danger') {
    const toastContainer = document.querySelector('.toast-container');
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toastBody');
    const toastIcon = document.getElementById('toastIcon');
    const toastProgress = document.getElementById('toastProgress');
    const delay = parseInt(toastEl.getAttribute('data-bs-delay'));

    // Configuration des styles par type
    const config = {
        danger: { color: '#f44336', icon: '!' }, // Rouge
        success: { color: '#28a745', icon: '✓' }, // Vert
        warning: { color: '#ff9800', icon: '⚠' }  // Orange
    };

    const current = config[type] || config.danger;

    // 1. Appliquer les styles dynamiques
    toastIcon.style.backgroundColor = current.color;
    toastProgress.style.backgroundColor = current.color;
    toastIcon.textContent = current.icon;
    toastBody.textContent = message;

    // 2. Afficher le conteneur
    toastContainer.style.display = 'block';

    // 3. Reset l'animation de la barre
    toastProgress.style.transition = 'none';
    toastProgress.style.width = '100%';

    // 4. Lancer le Toast Bootstrap
    const toast = bootstrap.Toast.getOrCreateInstance(toastEl);
    toast.show();

    // 5. Animation du trait (déclenchée juste après l'affichage)
    setTimeout(() => {
        toastProgress.style.transition = `width ${delay}ms linear`;
        toastProgress.style.width = '0%';
    }, 150);

    // 6. Nettoyage : cacher le conteneur quand le toast disparaît
    toastEl.addEventListener('hidden.bs.toast', () => {
        toastContainer.style.display = 'none';
    }, { once: true });
}

// function showNotification(message) {
//     const toastContainer = document.querySelector('.toast-container');
//     const toastEl = document.getElementById('liveToast');
//     const toastBody = document.getElementById('toastBody');
//     const toastProgress = document.getElementById('toastProgress');
//     const delay = parseInt(toastEl.getAttribute('data-bs-delay'));

//     // 1. Afficher le conteneur et préparer le message
//     toastContainer.style.display = 'block';
//     toastBody.textContent = message;

//     // 2. Reset la barre (important : enlever la transition pour le reset)
//     toastProgress.style.transition = 'none';
//     toastProgress.style.width = '100%';

//     // 3. Initialiser et montrer le toast Bootstrap
//     const toast = bootstrap.Toast.getOrCreateInstance(toastEl);
//     toast.show();

//     // 4. Lancer l'animation du trait (petit délai pour que le CSS l'accepte)
//     setTimeout(() => {
//         toastProgress.style.transition = `width ${delay}ms linear`;
//         toastProgress.style.width = '0%';
//     }, 100);

//     // 5. Recacher le conteneur quand le toast a fini de disparaître
//     toastEl.addEventListener('hidden.bs.toast', () => {
//         toastContainer.style.display = 'none';
//     }, { once: true });
// }