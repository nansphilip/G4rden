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

// Toggle dark mode
const toggleButtonEl = document.querySelector("#toggleTheme");

const toggleDarkMode = () => {
    // const iconElList = document.querySelectorAll(".icon-nav img")
    const iconElList = document.querySelectorAll(".icon-nav svg");
    const documentAllElList = document.querySelectorAll("body *");
    const rootEl = document.documentElement;

    // Remove transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "0ms";
    });
    document.body.scrollHeight; // Forces chronological repaint
    
    // Toggle dark mode
    rootEl.classList.toggle("dark");
    document.body.scrollHeight; // Forces chronological repaint
    
    // Restore transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "";
    });

    // Toggle icon
    if (rootEl.classList.contains("dark")) {
        iconElList[0].style.display = "none";
        iconElList[1].style.display = "";
    } else {
        iconElList[0].style.display = "";
        iconElList[1].style.display = "none";
    }

    // Todo : send preference to server
};

// On click, toggle dark mode
toggleButtonEl.addEventListener("click", toggleDarkMode);
