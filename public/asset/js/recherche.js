const form= document.getElementById('search-form');
form.addEventListener('submit', function(e){
    e.preventDefault();
    const token = document.querySelector("meta[name='csrf-token']").content;
    const url = this.getAttribute('action');
    const depart=document.getElementById('villeDepart').value;
    const arrivee=document.getElementById('villeArrivee').value;
    console.log(depart,arrivee);
    fetch(url,{
        method : 'POST',
        headers: {
            'Content-Type':'application/json',
            'Accept':'application/json',
            'X-CSRF-TOKEN': token
        },
        body : JSON.stringify({
            depart: depart,
            arrivee: arrivee,
        }).then(response => {
            if(!response.ok) throw response; //Les erreurs 422,500,etc.
            return response.json();
        })
        .then(data => {
            console.log("Resultats reçus :", data);
        })
        .catch(error => {
            console.error("Erreur lors de la recherche :", error);
        }
        )
    })

})