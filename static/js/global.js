import AsyncRouter from "/static/js/AsyncRouter.js";

// =========================== //
// === Arrow to top button === //
// =========================== //

const elementList = [document.querySelector("body"), document.querySelector("main")];
const arrowButtonEl = document.querySelector("#arrow_to_top");

// Toggles the button visibility
const toggleArrowButtonVisibility = () => {
    // From 10px
    elementList.forEach((el) => {
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
    el.addEventListener("scroll", toggleArrowButtonVisibility);
});

// On click, scroll to top
arrowButtonEl.addEventListener("click", backToTop);

// Toggle dark mode
const toggleButtonEl = document.querySelector("#toggleTheme");

const toggleDarkMode = async () => {
    // const iconElList = document.querySelectorAll(".icon-nav img")
    const iconElList = document.querySelectorAll(".icon-nav svg");
    const documentAllElList = document.querySelectorAll("body *");
    const rootEl = document.documentElement;

    // Remove transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "0ms";
    });
    document.body.scrollHeight; // Forces chronologicookiesListl repaint

    // Toggle dark mode
    rootEl.classList.toggle("dark");
    document.body.scrollHeight; // Forces chronologicookiesListl repaint

    // Restore transitions
    documentAllElList.forEach((el) => {
        el.style.transition = "";
    });

    // Toggle icon
    if (rootEl.classList.contains("dark")) {
        iconElList[0].style.display = "none";
        iconElList[1].style.display = "";
        const { status, message } = await AsyncRouter.post("post-theme", { theme: "dark" });
        if (status === "error") {
            throw new Error(message);
        }
    } else {
        iconElList[0].style.display = "";
        iconElList[1].style.display = "none";
        const { status, message } = await AsyncRouter.post("post-theme", { theme: "" });
        if (status === "error") {
            throw new Error(message);
        }
    }
};

// On click, toggle dark mode
toggleButtonEl.addEventListener("click", async () => await toggleDarkMode());

// ========================== //
// === Scroll bar padding === //
// ========================== //

const scrollableElementList = [
    document.querySelector("main"),
    document.querySelector("#directChat")
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
