let deleteUserButton = document.querySelector("#deleteUser");
// let inputUser = document.querySelector(".inputUsername");
// let username;

// //Add the click event listener to the deleteUserButton
deleteUserButton.addEventListener("click", deleteUser);

// //Function that calls the delete user method in php 
// function deleteUser(username){
//     username = inputUser.value;
//     //Prepare the function with the arguments
//     var call_Args = {
//         fonction : "deleteUser",
//         params: {
//             param1 : username
//         },
//     };
//     //Call the function
//     $('.retourFonction').load("deleteUser.php", call_Args);
    
//     // if(confirm("Voulez-vous supprimer l'utilisateur : " + username + " ?")){

//     // }
// }

// Lorsque le bouton est cliqué
//$('#deleteUser').click(
    // function deleteUser() {
    // // Paramètre que nous voulons envoyer
    // var param = $('.inputUsername').val();

//     // Requête AJAX
//     $.ajax({
//         url: 'deleteUser.php',   // Fichier PHP qui reçoit la requête
//         type: 'POST',          // Méthode de requête (POST)
//         data: { param: param }, // Paramètre à envoyer
//         dataType: 'json',      // Type de retour attendu (JSON)
//         success: function(response) {
//             // Affiche la réponse dans le div #result
//             if (response.success) {
//                 $('#retourFonction').text(response.message);
//             } else {
//                 $('#retourFonction').text('Erreur: ' + response.message);
//             }
//         },
//         error: function(xhr, status, error) {
//             // Gestion des erreurs
//             $('#retourFonction').text('Erreur AJAX: ' + error);
//         }
//     });
// };