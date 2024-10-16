// Set eye toggle button in the password field
const setToggleButtonPosition = () => {
    const toggleEyes = document.querySelector("#toggleEyes");
    const password = document.querySelector("#password");

    const toggleEyes1 = document.querySelector("#toggleEyes1");
    const confirmPassword = document.querySelector("#confirmPassword");

    const passwordRect = password.getBoundingClientRect();
    const passwordTop = Math.round(passwordRect.top);
    const passwordLeft = Math.round(passwordRect.left);
    const passwordHeight = Math.round(passwordRect.height);
    const passwordWidth = Math.round(passwordRect.width);

    const confirmPasswordRect = confirmPassword.getBoundingClientRect();
    const confirmPasswordTop = Math.round(confirmPasswordRect.top);
    const confirmPasswordLeft = Math.round(confirmPasswordRect.left);
    const confirmPasswordHeight = Math.round(confirmPasswordRect.height);
    const confirmPasswordWidth = Math.round(confirmPasswordRect.width);

    const toggleEyesRect = toggleEyes.getBoundingClientRect();
    const toggleEyesHeight = Math.round(toggleEyesRect.height);
    const toggleEyesWidth = Math.round(toggleEyesRect.width);

    const toggleEyes1Rect = toggleEyes1.getBoundingClientRect();
    const toggleEyes1Height = Math.round(toggleEyes1Rect.height);
    const toggleEyes1Width = Math.round(toggleEyes1Rect.width);

    toggleEyes.style.top = `${passwordTop + (passwordHeight - toggleEyesHeight) / 2}px`;
    toggleEyes.style.left = `${passwordLeft + passwordWidth - toggleEyesWidth - 8}px`;

    toggleEyes1.style.top = `${confirmPasswordTop + (confirmPasswordHeight - toggleEyes1Height) / 2}px`;
    toggleEyes1.style.left = `${confirmPasswordLeft + confirmPasswordWidth - toggleEyes1Width - 8}px`;
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

