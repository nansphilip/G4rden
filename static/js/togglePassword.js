function moveAllEyesButton() {
    const passwordInputList = document.querySelectorAll("input[type=password]");

    passwordInputList.forEach((passwordInput) => {
        const eye = passwordInput.parentNode.querySelectorAll(".toggleEyes")[0];
        move(passwordInput, eye);
    });
}

const setToggleButtonPosition = () => {
    const passwordInputList = document.querySelectorAll("input[type=password]");

    passwordInputList.forEach((passwordInput) => {
        const toggleEyes = document.createElement("div");
        toggleEyes.setAttribute("class", "toggleEyes");

        const closedEye = document.createElement("button");
        closedEye.setAttribute("class", "closed-eye");
        closedEye.setAttribute("type", "button");
        toggleEyes.appendChild(closedEye);

        const openedEye = document.createElement("button");
        openedEye.setAttribute("class", "opened-eye");
        openedEye.setAttribute("type", "button");
        openedEye.setAttribute("style", "display: none;");
        toggleEyes.appendChild(openedEye);

        const svgClosedEye = createSvg(closedEye);
        appendPath("m15 18-.722-3.25", svgClosedEye);
        appendPath("M2 8a10.645 10.645 0 0 0 20 0", svgClosedEye);
        appendPath("m20 15-1.726-2.05", svgClosedEye);
        appendPath("m4 15 1.726-2.05", svgClosedEye);
        appendPath("m9 18 .722-3.25", svgClosedEye);

        const svgOpenedEye = createSvg(openedEye);
        appendPath(
            "M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0",
            svgOpenedEye
        );

        const iconCircle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        iconCircle.setAttribute("cx", "12");
        iconCircle.setAttribute("cy", "12");
        iconCircle.setAttribute("r", "3");
        svgOpenedEye.appendChild(iconCircle);
        passwordInput.parentNode.appendChild(toggleEyes);

        toggleEyes.addEventListener("mouseover", () => show(passwordInput, toggleEyes));
        toggleEyes.addEventListener("mouseout", () => hide(passwordInput, toggleEyes));
    });
    moveAllEyesButton();
};

function move(password, eye) {
    const passwordRect = password.getBoundingClientRect();
    const passwordTop = Math.round(passwordRect.top);
    const passwordLeft = Math.round(passwordRect.left);
    const passwordHeight = Math.round(passwordRect.height);
    const passwordWidth = Math.round(passwordRect.width);

    const toggleEyesRect = eye.getBoundingClientRect();
    const toggleEyesHeight = Math.round(toggleEyesRect.height);
    const toggleEyesWidth = Math.round(toggleEyesRect.width);

    eye.style.top = `${passwordTop + (passwordHeight - toggleEyesHeight) / 2}px`;
    eye.style.left = `${passwordLeft + passwordWidth - toggleEyesWidth - 8}px`;
}

window.addEventListener("load", () => setToggleButtonPosition());
window.addEventListener("resize", () => moveAllEyesButton());

const show = (password, eye) => {
    toggleEyes(password, eye, true);
};

const hide = (password, eye) => {
    toggleEyes(password, eye, false);
};

const toggleEyes = (password, eye, show) => {
    const openedEye = eye.querySelector(".opened-eye");
    const closedEye = eye.querySelector(".closed-eye");

    if (show) {
        password.type = "text";
        closedEye.style.display = "none";
        openedEye.style.display = "";
    } else {
        password.type = "password";
        closedEye.style.display = "";
        openedEye.style.display = "none";
    }
};

function createSvg(closedEye) {
    const svgClosedEye = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svgClosedEye.setAttribute("class", "icon");
    svgClosedEye.setAttribute("viewBox", "0 0 24 24");
    svgClosedEye.setAttribute("stroke-linecap", "round");
    svgClosedEye.setAttribute("stroke-linejoin", "round");
    closedEye.appendChild(svgClosedEye);
    return svgClosedEye;
}

function appendPath(value, svg) {
    const iconPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    iconPath.setAttribute("d", value);
    svg.appendChild(iconPath);
}
