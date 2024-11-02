import AsyncRouter from "/static/js/AsyncRouter.js";

// ============================ //
// ===== Handle submission ==== //
// ============================ //

// Handle any form submission, and call the appropriate function
const formList = document.querySelectorAll("form");
formList.forEach((form) => {
    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        const formEl = event.target.name;

        if (formEl === "updateType") {
            await updateUserPrivilege(event);
        } else if (formEl === "deleteUser") {
            await deleteUser(event);
        } else if (formEl === "deleteMessage") {
            await displayMessageFromContent(event);
        } 
    });
});

// ================================ //
// ===== Update user privilege ==== //
// ================================ //

export const updateUserPrivilege = async (event) => {
    const formEl = event.target;

    // Get input values
    const username = formEl.querySelector("#selectUsernameForUpdateType").value;
    const userType = formEl.querySelector("#selectTypeForUpdateType").value;

    // Update user privilege
    const { data, error } = await AsyncRouter.post("admin/update-user-privilege", { username, userType });

    // Send feedback to user
    const consoleMessage = formEl.querySelector("#feedbackForUpdateType");

    data ? (consoleMessage.innerHTML = "Privilèges mis à jour.") : (consoleMessage.innerHTML = error);
};

// ========================== //
// ===== Delete a user  ===== //
// ========================== //

export const deleteUser = async (event) => {
    const formEl = event.target;

    // Get input values
    const username = formEl.querySelector("#searchDeleteUser").value;
    const action = formEl.querySelector("#selectDeleteUser").value;

    // Delete or anonymize user
    const { data, error } = await AsyncRouter.post("admin/anonymize-or-delete-user", { username, action });

    // Send feedback to user
    const consoleMessage = document.querySelector("#feedbackForDeleteUser");

    data ? (consoleMessage.innerHTML = data.action) : (consoleMessage.innerHTML = error);
};

// ========================== //
// ==== Display messages ==== //
// ========================== //

export const displayMessageFromContent = async (event) => {
    const formEl = event.target;
    const messageContainer = document.querySelector("#messageContainerForDeleteMessage");

    // Get input value
    const pieceOfMessage = formEl.querySelector("#selectForDeleteMessage").value;

    // Fetch the message list from the content sent
    const { data, error } = await AsyncRouter.post("admin/get-message-from-content", {
        pieceOfMessage,
    });

    messageContainer.innerHTML = "";

    //If error in php file print error in container
    if (!data) {
        return (messageContainer.innerHTML = "<div class='italic bold font-sm w-full center'>Aucun message.</div>");
    }

    // Add new messages if they does not already exist
    data.forEach((messageData) => {
        const { messageId, username, content, date } = messageData;

        // Stringify the id
        const stringMessageId = messageId.toString();

        // Format the date and time
        const newDate = new Date(date + "Z"); // Z to indicate UTC +0 timezone

        const options = {
            day: "numeric",
            month: "short",
            year: "numeric",
            hour: "numeric",
            minute: "2-digit",
            timeZone: timezoneConfig,
        };

        // Convert time to local time
        const dateTimeFormat = new Intl.DateTimeFormat("fr-FR", options);
        const [{ value: day }, , { value: month }, , { value: year }, , { value: hour }, , { value: minute }] =
            dateTimeFormat.formatToParts(newDate);

        // Display date and time
        const formattedDate = `${day} ${month} ${year}`;
        const formattedTime = `${hour}h${minute}`;

        // Create the new message element, display message on the right if the user is the current user, else on the left
        const newMessageEl = document.createElement("div");
        newMessageEl.classList.add("rounded-box-light", "flex", "flex-col", "gap-2", "items-center");
        newMessageEl.setAttribute("data-id", stringMessageId);

        // Create the new message content
        const messageContent = `<div class="w-full">
                <div class="flex flex-row justify-between">
                    <h3 class="bold">${username}</h3>
                    <div class="flex flex-row items-center gap-1">
                        <p>${formattedDate}</p>
                        <p>•</p>
                        <p>${formattedTime}</p>
                    </div>
                </div>
                <p>${content}</p>
            </div>
            <button type="button" class="delete-button" aria-label="Delete message">❌</button>`; // Added aria-label for accessibility

        // Insert content into the new message element
        newMessageEl.innerHTML = messageContent;

        // Add event listener to delete the message
        newMessageEl.querySelector(".delete-button").addEventListener("click", deleteMessage);

        // Add the new message to the chat container
        messageContainer.appendChild(newMessageEl);
    });
};

// ============================ //
// ===== Delete a message ===== //
// ============================ //

export const deleteMessage = async (event) => {
    const messageDivEl = event.target.parentNode;
    const messageId = messageDivEl.getAttribute("data-id");

    // Delete the message by its id
    const { data, error } = await AsyncRouter.post("admin/delete-message", { messageId });

    if (!data) {
        messageDivEl.innerHTML = error;
    }

    messageDivEl.innerHTML = "Message supprimé.";

    setTimeout(() => {
        messageDivEl.remove();
    }, 3000);
};

