import AsyncRouter from "/static/js/AsyncRouter.js";



// On devrait pas avoir besoin de cette fonction car on transmet l'id depuis la view
// Ça évite de faire une requete à chaque fois

// const getUserById = async () => {
//     try {
//         // Recup le user by Id
//         const { data, error } = await AsyncRouter.get("async/profile-update.php");


//         // Vérif ou erreur
//         if (data) {
//             pElement.textContent = `Username: ${data.username}`;
//         } else {
//             pElement.textContent = error;
//         }

//     } catch (error) {
//         console.error("Error fetching user data:", error);
//     }
// };



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

1. Ajouter un écouteur d'événement au 'submit' de nouveau formulaire
et prévenir de l'envoie classique (POST) avec `event.preventDefault()`.
Je te recomande de faire un `console.log(event)` pour savoir ce que ça contient.

2. Envoyer la nouvelle valeur du champ (username, firstname ou lastname)
et avec l'id de l'utilisateur au serveur de manière asynchrone avec `AsyncRouter.post()`.
J'ai ajouté la possibilité de retourner de la data avec 'post()' comme l'a demandé Théo.

3. Traiter la data sur le serveur et renvoyer un objet contenant : status, message et data.
Si l'objet data est null, il faut renvoyer un message d'erreur.

4. Afficher un feedback utilisateur pour le client.

*/


// Envoyer les données au serveur, traiter la réponse et afficher un feedback
const sendData = (event) => {

    // Empêcher le formulaire de se soumettre
    // Si tu mets pas ça, la requete POST est envoyée controleur correspondant à l'URL actuelle ("profile") et ça refresh la page 
    event.preventDefault();

    console.log("Event:", event);
    console.log("Form element:", event.target);
    console.log("Input value:", event.target.querySelector("input").value);
    console.log("User id:", event.target.querySelector("input").getAttribute("data-id"));

    // const inputValue = document.getElementById(field + '-input').value; // Utilise `field` pour récupérer la valeur de l'input

    // try {
    //     const { data, error } = await AsyncRouter.post("/async/profile-update.php", { [field]: inputValue });

    //     if (data) {
    //         // Mettre à jour l'affichage avec la nouvelle valeur
    //         document.getElementById(field + '-display').textContent = data[field]; // Met à jour le span d'affichage avec la nouvelle valeur
    //         document.getElementById(field + '-edit').style.display = 'none'; // Cache la zone d'édition
    //     } else {
    //         console.error(error); // Gère les erreurs
    //     }
    // } catch (error) {
    //     console.error("Error saving user data:", error); // Gère les erreurs lors de la sauvegarde
    // }
};

// Écouteur de bouton pour récupérer les données utilisateur
// const get_user_button = document.querySelector("#get_user_button");
// get_user_button.addEventListener("click", async () => await getUserById());


document.addEventListener("submit", (event) => sendData(event));