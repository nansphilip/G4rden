import AsyncRouter from "/static/js/AsyncRouter.js";

const getUserById = async () => {
    try {
        // Recup le user by Id
        const { data, error } = await AsyncRouter.get("async/profile-update.php");


        // Vérif ou erreur
        if (data) {
            pElement.textContent = `Username: ${data.username}`;
        } else {
            pElement.textContent = error;
        }

    } catch (error) {
        console.error("Error fetching user data:", error);
    }
};
// Basculer la zone d'édition
export const toggleButtonEdit = (field) => {
    const displaySpan = document.getElementById(field + '-display'); // Utilise `field` au lieu de `username`
    const editDiv = document.getElementById(field + '-edit'); // Utilise `field` au lieu de `username`

    // Cacher le span d'affichage et montrer la zone de texte
    displaySpan.style.display = 'none'; // Cache le span d'affichage
    editDiv.style.display = 'block'; // Affiche la zone d'édition
};

// Fonction pour sauvegarder les données
const saveData = async (field) => {
    const inputValue = document.getElementById(field + '-input').value; // Utilise `field` pour récupérer la valeur de l'input

    try {
        const { data, error } = await AsyncRouter.post("/async/profile-update.php", { [field]: inputValue });

        if (data) {
            // Mettre à jour l'affichage avec la nouvelle valeur
            document.getElementById(field + '-display').textContent = data[field]; // Met à jour le span d'affichage avec la nouvelle valeur
            document.getElementById(field + '-edit').style.display = 'none'; // Cache la zone d'édition
        } else {
            console.error(error); // Gère les erreurs
        }
    } catch (error) {
        console.error("Error saving user data:", error); // Gère les erreurs lors de la sauvegarde
    }
};

// Écouteur de bouton pour récupérer les données utilisateur
const get_user_button = document.querySelector("#get_user_button");
get_user_button.addEventListener("click", async () => await getUserById());
