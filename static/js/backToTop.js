window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    const backToTopButton = document.getElementById("backToTop");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.style.display = "block"; // Afficher le bouton
    } else {
        backToTopButton.style.display = "none"; // Masquer le bouton
    }
}

// Fonction pour revenir en haut de la page
function backToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // DÃ©filement fluide
    });
}