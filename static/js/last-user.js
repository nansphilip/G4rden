import AsyncRouter from "/static/js/async-router.js";

export const getLastUser = async () => {
    try {
        // Get the last user
        const response = await AsyncRouter.get("last-user");
        console.log(response);

        // Create a new paragraph element with the user data
        const pElement = document.createElement("p");
        pElement.textContent = response.data;

        // Select the main element and append the new paragraph
        const mainEl = document.querySelector("main");
        mainEl.appendChild(pElement);

    } catch (error) {
        console.error(error);
    }
};

// Add button listener, to execute the function
const buttonEl = document.querySelector("#last_user_button");
buttonEl.addEventListener("click", async () => await getLastUser());
