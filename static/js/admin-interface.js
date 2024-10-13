import AsyncRouter from "/static/js/AsyncRouter.js";

// ====================================== //
// ===== Async functions with wait  ===== //
// ====================================== //

function wait(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

// Function to clear the html content of an element
async function clearMessage(element) {
    await wait(4000);
    element.innerHTML = "";
}

// Function to delete an element
async function deleteElement(element) {
    await wait(4000);
    element.remove();
}

async function waitSeconds(seconds) {
    await wait(seconds * 1000);
}

// ======================================== //
// ===== Propose username suggestions ===== //
// ======================================== //

/* Function that propose username suggestions to the user, and put them in a div below
for each letter entered, it searches for users matching the username in the database */
export const searchUser = async (inputElement, suggestionElement) => {
    // Point to each input field and get its value
    const search = document.getElementById(inputElement);
    const username = search.value.toLowerCase();
    // Point to the div to put suggestions
    const suggestions = document.getElementById(suggestionElement);

    // Checks if the input has at least one character
    if (username.length > 0) {
        // Get all users matching the username
        const { data, error } = await AsyncRouter.post("search-user", { username });
        // Clear the suggestions div
        suggestions.innerHTML = "";
        // If data is not null, display the usernames suggestions
        if (data) {
            data.forEach((user) => {
                // Create the suggestion div for each user
                const suggestion = document.createElement("div");
                suggestion.classList.add("suggestion-item");
                suggestion.innerHTML = user.username;
                // Add event listener to each suggestion div to input the username in the input field when the user click on it
                suggestion.addEventListener("click", async () => {
                    search.value = user.username;
                    suggestions.style.display = "none";
                });
                suggestions.appendChild(suggestion);
            });
            // Display the div suggestion
            suggestions.style.display = "block";
        } else {
            // If no data, hide the div suggestions
            suggestions.style.display = "none";
            console.log(error);
        }
    } else {
        // Hide the suggestion div if the input is empty
        suggestions.style.display = "none";
    }
};

// Listener on each input field to search user and put suggestions on the div below
const allInput = {
    searchDeleteUser: "suggestionsDeleteUser",
    searchDeleteMessage: "suggestionsDeleteMessage",
    searchChangeType: "suggestionsChangeType",
};
for (const [input, suggestion] of Object.entries(allInput)) {
    const inputSearchUser = document.getElementById(input);
    inputSearchUser.addEventListener("input", async () => await searchUser(input, suggestion));
}

// Listener on each suggestion div to close them when the user click on document
document.addEventListener("click", async () => {
    const allSuggestions = ["suggestionsDeleteUser", "suggestionsDeleteMessage", "suggestionsChangeType"];
    allSuggestions.forEach((suggestion) => {
        const suggestions = document.getElementById(suggestion);
        suggestions.style.display = "none";
    });
});

// ========================== //
// ===== Delete a user  ===== //
// ========================== //

export const deleteUser = async () => {
    // Point to the username input field and affect its value to the variable username
    let inputUser = document.querySelector("#searchDeleteUser");
    let username = inputUser.value;

    // Point to the select
    const select = document.querySelector("#selectDeleteMessage");
    let selectValue = select.value;

    // Delete the user by its username, get the message in return and display it in the console div
    const { message, error } = await AsyncRouter.post("delete-user", { username, selectValue });

    // Point to the console message to show the data message
    let consoleMessage = document.querySelector("#consoleMessage");
    if (message) {
        consoleMessage.innerHTML = message;
    } else {
        consoleMessage.innerHTML = error;
    }
};

// Add listener on delete user button, to execute the function
const buttonDelete = document.querySelector("#deleteUser");
buttonDelete.addEventListener("click", async () => await deleteUser());

// ========================== //
// ==== Delete a message ==== //
// ========================== //

/* Function that display all messages of a user, and allow the user to delete a message
by clicking on the delete button on the right of each message*/
export const showAllMessages = async () => {
    // Point to the form fields and gets their value
    let inputUser = document.querySelector("#searchDeleteMessage");
    let usernameAuthor = inputUser.value;
    let inputMsg = document.querySelector("#inputMessage");
    let keyMessage = inputMsg.value;
    let messageContainer = document.querySelector("#messages-container");

    // Send the username and the key to search for messages and gets in return all the messages corresponding
    const { message, data, error } = await AsyncRouter.post("search-and-destroy-message", {
        usernameAuthor,
        keyMessage,
    });

    // Affect the returned message to the div if error
    if (!message) {
        messageContainer.innerHTML = "error: " + error;
        // Wait 5 secondes then clear the message
        clearMessage(messageContainer);
        return;
    }

    // Delete the former messages in the container
    if (messageContainer.hasChildNodes()) {
        messageContainer.innerHTML = "";
    }

    // For all messages, create new element with the message content
    for (var i = 0; i < data.length; i++) {
        const { id, content, date, userId } = data[i];
        let idMessage = id;
        // Create the new message element
        const newMessageDiv = document.createElement("div");
        newMessageDiv.classList.add("rounded-box-light");
        newMessageDiv.setAttribute("id", "message-" + idMessage);

        // Create the new message content
        const messageContent = `<div class="flex flex-row justify-between">
            <h3>${usernameAuthor}</h3>
            <div class="flex flex-row items-center gap-1">
                <p>${date}</p>
                <button type="button" id="delete-${idMessage}" class="delete-message">❌</button>
            </div>
        </div>
        <p>${content}</p>`;

        // Insert content into the new message element
        newMessageDiv.innerHTML = messageContent;

        // Add the new message to the message container
        messageContainer.appendChild(newMessageDiv);

        // Add event listener to delete message content
        const deleteMessage = document.querySelector("#delete-" + idMessage);
        deleteMessage.addEventListener("click", async () => await deleteMessageContent(idMessage));
    }
};

// Add button listener
const buttonSearch = document.querySelector("#searchMessage");
buttonSearch.addEventListener("click", async () => await showAllMessages());

// ============================ //
// ===== Delete a message ===== //
// ============================ //

// Function that delete a message when the user click on the delete button
export const deleteMessageContent = async (idMessage) => {
    const messageContainer = document.querySelector("#messages-container");

    // Delete the message by its id
    const { message, error } = await AsyncRouter.post("delete-message", { idMessage });

    //If error in php file print error in container
    if (!message) {
        return (messageContainer.innerHTML = "error: " + error);
    }

    //Clear the message in container
    const messageDiv = document.querySelector("#message-" + idMessage);
    messageDiv.innerHTML = message;
    //Wait 5 secondes then delete the element message
    deleteElement(messageDiv);
};

// ================================ //
// ===== Change user privilege ==== //
// ================================ //

export const changeUserPrivilege = async () => {
    // Point to the username input field and affect its value to the variable username
    const searchChangeType = document.querySelector("#searchChangeType");
    let username = searchChangeType.value;
    // Point to the privilege select
    const select = document.querySelector("#selectChangeType");
    let selectValue = select.value;
    // Delete the user by its username, get the message in return and display it in the console div
    const { message, error } = await AsyncRouter.post("change-user-privilege", { username, selectValue });

    // Point to the console message to show the data message
    let consoleMessage = document.querySelector("#consoleUserType");
    if (message) {
        consoleMessage.innerHTML = message;
    } else {
        consoleMessage.innerHTML = error;
    }
};

// Add listener on change user type button, to execute the function
const buttonChangeType = document.querySelector("#changeUserType");
buttonChangeType.addEventListener("click", async () => await changeUserPrivilege());
