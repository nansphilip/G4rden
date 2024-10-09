import AsyncRouter from "/static/js/AsyncRouter.js";

// Je ne pense pas que ce soit nécessaire de masquer le champ lorsque l'utilisateur arrve sur la page
// car son but est de modifer des valeurs du profil directement.

// export const toggleButtonEdit = (field) => {
//     const displaySpan = document.getElementById(field + '-display'); // Utilise `field` au lieu de `username`
//     const editDiv = document.getElementById(field + '-edit'); // Utilise `field` au lieu de `username`


//     // Cacher le span d'affichage et montrer la zone de texte
//     displaySpan.style.display = 'none'; // Cache le span d'affichage
//     editDiv.style.display = 'block'; // Affiche la zone d'édition
// };


/*
Instructions:

2. Envoyer la nouvelle valeur du champ (username, firstname ou lastname)
et avec l'id de l'utilisateur au serveur de manière asynchrone avec `AsyncRouter.post()`.
J'ai ajouté la possibilité de retourner de la data avec 'post()' comme l'a demandé Théo.

3. Traiter la data sur le serveur et renvoyer un objet contenant : status, message et data.
Si l'objet data est null, il faut renvoyer un message d'erreur.

4. Afficher un feedback utilisateur pour le client.

*/


// Envoyer les données au serveur, traiter la réponse et afficher un feedback
const sendData = async (event) => {

    // Empêcher le formulaire de se soumettre
    event.preventDefault();

    const profilDataUpdate = {
        submitName: event.submitter.name,
        inputValue: event.target.querySelector("input").value,
        userId: event.target.querySelector("input").getAttribute("data-id")
    }

    try {
        const { profilDataUpdate, error } = await AsyncRouter.post("/async/profile-update.php", { [field]: inputValue });
        console.log(profilDataUpdate);
        // if (profilDataUpdate) {
            // Mettre à jour l'affichage avec la nouvelle valeur
           // document.getElementById(field + '-display').textContent = data[field]; // Met à jour le span d'affichage avec la nouvelle valeur
            //document.getElementById(field + '-edit').style.display = 'none'; // Cache la zone d'édition
        //} else {
        //    console.error(error); // Gère les erreurs
        //}
    } catch (error) {
        console.error("Error saving user data:", error); // Gère les erreurs lors de la sauvegarde
    }
    
};

// Écouteur de bouton pour récupérer les données utilisateur
// const get_user_button = document.querySelector("#get_user_button");
// get_user_button.addEventListener("click", async () => await getUserById());


document.addEventListener("submit", (event) => sendData(event));