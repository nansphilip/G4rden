const arrowButtonEl = document.querySelector("#arrow_to_top");

// Toggles the button visibility
const toggleButtonVisibility = () => {
    // From 100px
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        // Display the button
        arrowButtonEl.disabled = false;
        arrowButtonEl.style.opacity = "100%";
    } else {
        // Hide the button
        arrowButtonEl.disabled = true;
        arrowButtonEl.style.opacity = "0%";
    }
};

// Scrolls to top
const backToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
};

window.addEventListener("load", toggleButtonVisibility);

// On scroll, toggle the button visibility
window.addEventListener("scroll", toggleButtonVisibility);

// On click, scroll to top
arrowButtonEl.addEventListener("click", backToTop);
