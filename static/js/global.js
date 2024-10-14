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
        setCookie("darkTheme", "enabled");
    } else {
        iconElList[0].style.display = "";
        iconElList[1].style.display = "none";
        destroyCookie("darkTheme");
    }
};

// On click, toggle dark mode
toggleButtonEl.addEventListener("click", toggleDarkMode);

const setCookie = (name, value) => {
    const cookieValue = name + "=" + value + ";";
    const cookieExpires = "expires=" + new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toUTCString() + ";";
    const cookiePath = "path=/;";
    (document.cookie = cookieValue), cookieExpires, cookiePath;
};

const getCookie = (name) => {
    const cookieName = name + "=";
    return document.cookie.split(";").some((el) => {
        const cookie = el.trim();
        return cookie.indexOf(cookieName) === 0 && cookie.substring(cookieName.length) === "enabled";
    });
};

const destroyCookie = (name) => {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
};

window.addEventListener("load", () => {
    if (getCookie("darkTheme")) {
        toggleDarkMode();
    }
});
