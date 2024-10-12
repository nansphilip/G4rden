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


// Envoyer les données au serveur, traiter la réponse et affic²her un feedback
const sendData = async (event) => {

    // Empêcher le formulaire de se soumettre
    event.preventDefault();
    let form = {
        "username": event.target.querySelector("input#username").value,
        "firstname": event.target.querySelector("input#firstname").value,
        "lastname": event.target.querySelector("input#lastname").value,
        "password": event.target.querySelector("input#password").value,
        "passwordConfirm": event.target.querySelector("input#passwordConfirm").value,
    }

    const formValues = {
        username: event.target.querySelector("input#username").value,
        firstname: event.target.querySelector("input#firstname").value,
        lastname: event.target.querySelector("input#lastname").value,
        password: event.target.querySelector("input#password").value,
        passwordConfirm: event.target.querySelector("input#passwordConfirm").value,
    };

    try {
        const { data, error } = await AsyncRouter.post("put-profile", formValues);

        if (!data) {
            throw new Error(error);
        }

        alert(`Update success: ${data}`);
    } catch (error) {
        alert(error);
    }

    document.querySelector('form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('confirm-password').value;

        if (password !== passwordConfirm) {
            e.preventDefault();
            alert("Password not match !")
        }


    })
    
};

// Écouteur de bouton pour récupérer les données utilisateur
// const get_user_button = document.querySelector("#get_user_button");
// get_user_button.addEventListener("click", async () => await getUserById());


document.addEventListener("submit", (event) => sendData(event));

document.getElementById('view').addEventListener('click', function () {
    var passwordField = document.getElementById('password');

    // Basculer le type d'input entre "password" et "text"
    if (passwordField.type === 'password') {
        passwordField.type = 'text'; // Afficher le mot de passe en clair
    } else {
        passwordField.type = 'password'; // Revenir au mot de passe masqué
    }
});
document.getElementById('hide').addEventListener('click', function () {
    var passwordField = document.getElementById('passwordConfirm');

    // Basculer le type d'input entre "password" et "text"
    if (passwordField.type === 'password') {
        passwordField.type = 'text'; // Afficher le mot de passe en clair
    } else {
        passwordField.type = 'password'; // Revenir au mot de passe masqué
    }
});
