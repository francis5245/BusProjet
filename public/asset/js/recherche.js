document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("search-form");
    const resultContainer = document.getElementById("tripsWrapper");
    const loader = document.getElementById("loader");
    //Nouvelles références pour le basculement de la page
    const sectionAccueil=document.getElementById("section-accueil");
    const sectionResultats=document.getElementById('section-resultats')
    if(form){
           form.addEventListener("submit", function (e) {

        e.preventDefault(); // Empêche le rechargement
            //recuperation des champs
        const departId = document.getElementById("villeDepart").value;
        const arriveeId = document.getElementById("villeArrivee").value;
        const dateDepart = document.getElementById("dateDepart").value;

        // Vérification des champs
        if (!departId || !arriveeId || !dateDepart) {

            Swal.fire({
                icon: "warning",
                title: "Champs manquants",
                text: "Veuillez sélectionner la ville de départ, la destination et la date.",
                width: "300px"
            });

            return; // stop la recherche
        }
        // empêcher que l'utilisateur choisisse la même ville pour départ et arrivée.
        if (departId === arriveeId) {
            Swal.fire({
                icon: "warning",
                title: "Choix invalide",
                text: "La ville de départ et d'arrivée doivent être différentes.",
                width: "300px"
            });
            return;
        }
        // cacher le texte par défaut
        defaultText.style.display = "none";

        // afficher loader
        loader.style.display = "block";
        resultContainer.innerHTML = "";

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
                    defaultText.style.display = "block";
                    prevBtn.style.display = "none";
                    nextBtn.style.display = "none";

                    Swal.fire({
                        icon: "info",
                        title: "Information",
                        text: data.message, // message venant du serveur
                        width: "300px"
                    });

                    return;
                }

                afficherResultats(data.voyages);

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

                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue pendant la recherche",
                    width: "300px"
                });

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