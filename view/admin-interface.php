<?php
// Admin interface view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main class="flex flex-column gap-3">
    <div>
        <h2><?= App::$pageTitle; ?></h2>
        <p>G4rden's admin interface.</p>
    </div>

    <!--
    
    Yo Théo, solide pour l'autocompletion en JS !
    Ça marche bien, seulement, ça provoque une requête à chaque lettre que l'on tape.

    Le prof demande que le code soit optimisé. Je pense que tu vas pouvoir améliorer ça
    hyper rapidement avec un élément fait pour cela : https://developer.mozilla.org/en-US/docs/Web/HTML/Element/datalist

    Process pour l'autocompletion :
        - dans le controleur, tu récupères tous les noms d'utilisateurs dans un tableau

        - avec une boucle foreach/endfor tu remplis le champ datalist avec les utilisateurs trouvés

        ex: <?php foreach ($users as $user): ?>
                <option value="<?= $user['username']; ?>"><?= $user['username']; ?></option>
            <?php endforeach; ?>

        - en JS, tu fais que les submits en asynchrone

    Après cela, tu devrais avoir un JS beaucoup plus épuré et un serveur content de ne pas
    recevoir trop de requêtes.

    ------------------------------------------------------------------------------------------

    Pour le CSS, j'ai merge les dernières modifications de main sur cette branche. Donc tu as
    les styles pour tout ce qu'il faut.

    Tu utiliseras probablement : components.css et utils.css. Mais n'hésite pas à ajouter une
    feuille de style spécifique à ta page si besoin.
    
    Dans le fichier global.css, tu peux
    retrouver des variables CSS qui sont disponibles partout et sont la base de 
    notre thème de couleurs. C'est aussi ce qui permet d'avoir un thème clair
    et un thème sombre.

    ------------------------------------------------------------------------------------------

    Pour le JS, tu peux essayer de factoriser ton code si tu en as envie. C'est plus pour
    la beauté du code que pour la performance. Même si parfois, l'un entraine l'autre.

    En tout cas, t'as rédigé un sacré morceau de code ! Bien joué !

    -->
        

    <!-- Delete a user -->
    <div class="flex flex-column gap-1 rounded-box mb-2">
        <h3>Supprimer un utilisateur</h3>
        <p>Entrez le nom de l'utilisateur à supprimer.</p>
        <div style="position: relative;"> <!-- Positionner le conteneur -->
            <input type="text" id="searchDeleteUser" placeholder="Pseudo de l'utilisateur" />
            <div id="suggestionsDeleteUser" class="suggestions"></div>
        </div>
        <!-- <input type="text" class="margin w-fit-content" id="inputUsername" placeholder="Pseudo de l'utilisateur"> -->
        <label for="selectDeleteMessage" class="bold">Messages de l'utilisateur: </label>
        <select class="margin w-fit-content" id="selectDeleteMessage">
            <option value="updateMessages">Conserver ses messages en anonymisant leur auteur</option>
            <option value="deleteMessages">Supprimer tous ses messages</option>
        </select>
        <button type="button" class="margin w-fit-content" id="deleteUser">Supprimer</button>
        <div id="consoleMessage"></div>
    </div>
    <!-- Test de recherche user avec propositions -->


    <!-- Delete a message -->
    <div class="flex flex-column gap-1 rounded-box mb-2">
        <h3>Supprimer un message</h3>
        <p>Entrez le nom de l'utilisateur</p>
        <div style="position: relative;"> <!-- Positionner le conteneur -->
            <input type="text" id="searchDeleteMessage" placeholder="Pseudo de l'utilisateur" />
            <div id="suggestionsDeleteMessage" class="suggestions"></div>
        </div>
        <!-- <input type="text" class="margin w-fit-content" id="usernameMessage" placeholder="Pseudo de l'utilisateur"> -->
        <p>Entrez un mot clé du message à rechercher.</p>
        <input type="text" class="margin w-fit-content" id="inputMessage" placeholder="Mot clé">
        <button type="button" class="margin w-fit-content" id="searchMessage">Rechercher</button>

        <div id="messages-container" class="flex-1 flex flex-column gap-2 overflow-y-auto padding-shadow">
            <!-- Messages will be injected here -->
        </div>
    </div>

    <!-- Change the userType of a user -->
    <div class="flex flex-column gap-1 rounded-box mb-2">
        <h3>Modifier les privilèges d'un utilisateur</h3>
        <p>Entrez le nom de l'utilisateur</p>
        <div style="position: relative;"> <!-- Positionner le conteneur -->
            <input type="text" id="searchChangeType" placeholder="Pseudo de l'utilisateur" />
            <div id="suggestionsChangeType" class="suggestions"></div>
        </div>
        <!-- <input type="text" class="margin w-fit-content" id="usernameChangeType" placeholder="Pseudo de l'utilisateur"> -->
        <p>Choisissez le nouveau privilège</p>
        <select class="margin w-fit-content" id="selectChangeType">
            <option value="USER">Utilisateur</option>
            <option value="ADMIN">Administrateur</option>
        </select>
        <button type="button" class="margin w-fit-content" id="changeUserType">Modifier</button>
        <div id="consoleUserType"></div>
    </div>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>