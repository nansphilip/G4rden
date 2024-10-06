import AsyncRouter from "/static/js/AsyncRouter.js";

export const getLastUser = async () => {
    // Get the last user
    const { data, error } = await AsyncRouter.get("last-user");

    // Create a new paragraph element with the user data
    let pElement = document.createElement("p");

    // Create a new paragraph element with the user data
    data ? (pElement.textContent = data) : (pElement.textContent = error);

    // Select the main element and append the new paragraph
    const mainEl = document.querySelector("main");
    mainEl.appendChild(pElement);
};

// Add button listener, to execute the function
const buttonEl = document.querySelector("#last_user_button");
buttonEl.addEventListener("click", async () => await getLastUser());
