import AsyncRouter from "/static/js/AsyncRouter.js";

// Get the chat container
const chatContainerEl = document.querySelector("#chatContainer");

// Get the subject id
const subjectId = chatContainerEl.getAttribute("data-subject-id");

// ============================== //
// === Async refresh messages === //
// ============================== //

const refreshMessages = async () => {
    // Get the messages
    const { data, error } = await AsyncRouter.post("message/get-message", { subjectId });

    // Create a new paragraph element with the user data
    if (error) {
        return (chatContainerEl.innerHTML = error);
    }

    // Store the scroll position
    const scrollBottomPosition = Math.round(chatContainerEl.scrollTop + chatContainerEl.clientHeight);
    const scrollHeight = chatContainerEl.scrollHeight;
    const isScrollAtBottom = scrollBottomPosition >= scrollHeight - 30;

    // Set an empty id list
    const currentIdList = [];
    // Get current messages id list
    const currentMessageList = document.querySelectorAll("#chatContainer > div");
    // Get current messages id list
    if (currentMessageList.length > 0) {
        currentMessageList.forEach((messageDiv) => {
            currentIdList.push(messageDiv.getAttribute("data-id"));
        });
    }

    // Add new messages if they does not already exist
    data.forEach((messageData) => {
        const { userId, messageId, username, content, date } = messageData;

        // Stringify the id
        const stringMessageId = messageId.toString();

        // If the new message is not in the current list, add it
        if (!currentIdList.includes(stringMessageId)) {

            // Format the date and time
            const newDate = new Date(date + "Z"); // Z to indicate UTC +0 timezone

            const options = {
                day: "numeric",
                month: "short",
                year: "numeric",
                hour: "numeric",
                minute: "2-digit",
                timeZone: timezoneConfig
            };

            // Convert time to local time
            const dateTimeFormat = new Intl.DateTimeFormat("fr-FR", options);
            const [{ value: day },,{ value: month },,{ value: year },,{ value: hour },,{ value: minute }] = dateTimeFormat.formatToParts(newDate);
    
            // Display date and time
            const formattedDate = `${day} ${month} ${year}`;
            const formattedTime = `${hour}h${minute}`;

            // Get user id form view
            const currentUserId = chatContainerEl.getAttribute("data-user-id");

            // Create the new message element, display message on the right if the user is the current user, else on the left
            const newMessageEl = document.createElement("div");
            newMessageEl.classList.add("rounded-box-light", currentUserId === userId.toString() ? "right-message" : "left-message");
            newMessageEl.setAttribute("data-id", stringMessageId);

            // Create the new message content
            const messageContent = `<div class="flex flex-row justify-between">
                    <h3>${username}</h3>
                    <div class="flex flex-row items-center gap-1">
                        <p>${formattedDate}</p>
                        <p>•</p>
                        <p>${formattedTime}</p>
                    </div>
                </div>
                <p>${content}</p>`;

            // Insert content into the new message element
            newMessageEl.innerHTML = messageContent;

            // Add the new message to the chat container
            chatContainerEl.appendChild(newMessageEl);
        }
    });

    if (currentMessageList.length === 0) {
        // On initial load, instantly scroll to the bottom
        chatContainerEl.scrollTop = chatContainerEl.scrollHeight;
    } else {
        // If scroll position was at the bottom, scroll to the bottom
        if (isScrollAtBottom) {
            // On refresh, smoothly scroll to the bottom
            chatContainerEl.scrollTo({
                top: chatContainerEl.scrollHeight,
                behavior: "smooth",
            });
        }
    }
};

// On load, insert first messages, and add a refresh every 2 seconds
document.addEventListener("DOMContentLoaded", () => {
    refreshMessages();
    setInterval(refreshMessages, 2000);
});

// ================================ //
// === Async submit new message === //
// ================================ //

const newMessageFormEl = document.querySelector("#addNewMessage");

const handleSubmit = async (e) => {
    e.preventDefault();

    // Get the message
    const content = newMessageFormEl.reply.value;

    // Get the date in UTC +0 timezone
    const date = new Date().toISOString();

    // Add the message to the database
    const { data, error } = await AsyncRouter.post("message/add-message", { content, date, subjectId });

    if (data) {
        // Refresh messages
        refreshMessages();
    } else {
        // Insert an error message in the chat container
        const newMessageEl = document.createElement("div");
        newMessageEl.classList.add("rounded-box");
        newMessageEl.innerHTML = error;
        chatContainerEl.appendChild(newMessageEl);
    }

    // Clear the input
    newMessageFormEl.reply.value = "";
};

// On submit, handle the submit to manage insertion asynchronously
newMessageFormEl.addEventListener("submit", handleSubmit);

