import AsyncRouter from "/static/js/AsyncRouter.js";

// =========================== //
// === Arrow to top button === //
// =========================== //

const elementList = [
    document.querySelector("body"),
    document.querySelector("main"),
    document.querySelector("#subjectContainer"),
];
const arrowButtonEl = document.querySelector("#arrow_to_top");

// Toggles the button visibility
const toggleArrowButtonVisibility = () => {
    // From 10px
    elementList.forEach((el) => {
        if (!el) return;
        if (el.scrollTop > 10) {
            // Display the button
            arrowButtonEl.disabled = false;
            arrowButtonEl.style.opacity = "100%";
        } else {
            // Hide the button
            arrowButtonEl.disabled = true;
            arrowButtonEl.style.opacity = "0%";
        }
    });
};

// Scrolls to top
const backToTop = () => {
    if (!elementList) return;
    elementList.forEach((el) => {
        el.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
};

// On load, toggle the button visibility
window.addEventListener("load", toggleArrowButtonVisibility);

// On scroll, toggle the button visibility
elementList.forEach((el) => {
    if (!el) return;
    el.addEventListener("scroll", toggleArrowButtonVisibility);
});

// On click, scroll to top
arrowButtonEl.addEventListener("click", backToTop);

// Toggle dark mode
const toggleButtonElList = document.querySelectorAll(".toggle-theme");
const rootEl = document.documentElement;

const toggleDarkMode = () => {
    const documentAllElList = document.querySelectorAll("body *");

    // Remove transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "0ms";
    });
    document.body.scrollHeight; // Used to forces chronologic script processing

    // Toggle dark mode
    rootEl.classList.toggle("dark");
    document.body.scrollHeight; // Used to forces chronologic script processing

    // Restore transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "";
    });

    // Toggle icon
    toggleIcons();
};

const toggleIcons = async () => {
    const iconElList = document.querySelectorAll(".icon-nav svg");
    
    // Toggle icon
    if (rootEl.classList.contains("dark")) {
        iconElList[0].style.display = "none";
        iconElList[1].style.display = "";
        iconElList[2].style.display = "none";
        iconElList[3].style.display = "";
        const { status, message } = await AsyncRouter.post("post-theme", { theme: "dark" });
        if (status === "error") {
            throw new Error(message);
        }
    } else {
        iconElList[0].style.display = "";
        iconElList[1].style.display = "none";
        iconElList[2].style.display = "";
        iconElList[3].style.display = "none";
        const { status, message } = await AsyncRouter.post("post-theme", { theme: "" });
        if (status === "error") {
            throw new Error(message);
        }
    }
};

window.addEventListener("load", toggleIcons);

// On click, toggle dark mode
toggleButtonElList.forEach((el) => {
    el.addEventListener("click", toggleDarkMode);
});

// ========================== //
// === Scroll bar padding === //
// ========================== //

const scrollableElementList = [
    document.querySelector("#subjectContainer"),
    document.querySelector("#chatContainer"),
    document.querySelector("#loginForm"),
    document.querySelector("#registerForm"),
];

const toggleScrollBarPadding = () => {
    scrollableElementList.forEach((el) => {
        if (!el) return;

        // Get the scroll position
        const isScrollBarVisible = el.scrollHeight > el.clientHeight;

        // If the scroll position is at the top, add padding
        if (isScrollBarVisible) {
            el.style.paddingRight = "0.5rem";
        } else {
            el.style.paddingRight = "";
        }
    });
};

// On load or resize, check if the scroll bar is visible
document.addEventListener("DOMContentLoaded", toggleScrollBarPadding);
window.addEventListener("resize", toggleScrollBarPadding);

// On scroll, check if the scroll bar is visible
scrollableElementList.forEach((el) => {
    if (!el) return;
    el.addEventListener("scroll", toggleScrollBarPadding);
});
