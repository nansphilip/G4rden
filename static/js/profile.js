// Set eye toggle button in the password field
const setToggleButtonPosition = () => {
    const toggleEyes = document.querySelector("#toggleEyes");
    const password = document.querySelector("#password");

    const passwordRect = password.getBoundingClientRect();
    const passwordTop = Math.round(passwordRect.top);
    const passwordLeft = Math.round(passwordRect.left);
    const passwordHeight = Math.round(passwordRect.height);
    const passwordWidth = Math.round(passwordRect.width);

    const toggleEyesRect = toggleEyes.getBoundingClientRect();
    const toggleEyesHeight = Math.round(toggleEyesRect.height);
    const toggleEyesWidth = Math.round(toggleEyesRect.width);

    toggleEyes.style.top = `${passwordTop + (passwordHeight - toggleEyesHeight) / 2}px`;
    toggleEyes.style.left = `${passwordLeft + passwordWidth - toggleEyesWidth - 8}px`;
};

document.addEventListener("DOMContentLoaded", () => setToggleButtonPosition());

// Toggle eye button
const toggleEyes = () => {
    const openedEye = document.querySelector("#opened-eye");
    const closedEye = document.querySelector("#closed-eye");
    const password = document.querySelector("#password");

    if (password.type === "password") {
        password.type = "text";
        closedEye.style.display = "none";
        openedEye.style.display = "";
    } else {
        password.type = "password";
        closedEye.style.display = "";
        openedEye.style.display = "none";
    }
};

const toggleEyesButton = document.querySelector("#toggleEyes");
toggleEyesButton.addEventListener("click", toggleEyes);