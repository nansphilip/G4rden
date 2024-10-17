import AsyncRouter from "/static/js/AsyncRouter.js";

const chatContainerEl = document.querySelector("#directChat");

// ============================== //
// === Async refresh messages === //
// ============================== //

const refreshMessages = async () => {
    // Get the messages
    const { data, error } = await AsyncRouter.post("message/get-message", { subject: null });

    // Create a new paragraph element with the user data
    if (error) {
        return (chatContainerEl.innerHTML = error);
    }

    // Store the scroll position
    const scrollBottomPosition = Math.round(chatContainerEl.scrollTop + chatContainerEl.clientHeight);
    const scrollHeight = chatContainerEl.scrollHeight;
    const isScrollAtBottom = scrollBottomPosition >= scrollHeight - 5;

    // Set an empty id list
    const currentIdList = [];
    // Get current messages id list
    const currentMessageList = document.querySelectorAll("#directChat > div");
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
            const newDate = new Date(date);
            const dateFormat = newDate.toLocaleDateString("fr-FR", { day: "numeric", month: "long" });
            const timeFormat = newDate.toLocaleTimeString("fr-FR", { hour: "2-digit", minute: "2-digit" });

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
                        <p>${dateFormat}</p>
                        <p>•</p>
                        <p>${timeFormat}</p>
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

    // Get the date
    const date = new Date().toISOString();

    // Add the message to the database
    const { data, error } = await AsyncRouter.post("message/post-message", { content, date });

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

// ========================== //
// === Scroll bar padding === //
// ========================== //

const togglePadding = () => {
    // Get the scroll position
    const isScrollBarVisible = chatContainerEl.scrollHeight > chatContainerEl.clientHeight;

    // If the scroll position is at the top, add padding
    if (isScrollBarVisible) {
        chatContainerEl.style.paddingRight = "0.5rem";
    } else {
        chatContainerEl.style.paddingRight = "";
    }
};

document.addEventListener("DOMContentLoaded", togglePadding);
window.addEventListener("resize", togglePadding);
chatContainerEl.addEventListener("scroll", togglePadding);
