import AsyncRouter from "/static/js/async-router.js";

const chatContainerEl = document.querySelector("#directChat");

// ============================== //
// === Async refresh messages === //
// ============================== //

const refreshMessages = async () => {
    // Get the messages
    const { data, error } = await AsyncRouter.get("get-message");

    // Create a new paragraph element with the user data
    if(!data) {
        return chatContainerEl.innerHTML = error;
    }

    let htmlMessageList = "";
    
    data.forEach(messageData => {
        const { username, message, date } = messageData;

        const newDate = new Date(date);
        const dateFormat = newDate.toLocaleDateString("fr-FR", { day: 'numeric', month: 'short' });
        const timeFormat = newDate.toLocaleTimeString("fr-FR", { hour: '2-digit', minute: '2-digit' });

        const messageFormat =
            `<div class="rounded-box">
                <div class="flex flex-row justify-between">
                    <h3>${username}</h3>
                    <div class="flex flex-row items-center gap-1">
                        <p>${dateFormat}</p>
                        <p>•</p>
                        <p>${timeFormat}</p>
                    </div>
                </div>
                <p>${message}</p>
            </div>`;

        htmlMessageList += messageFormat;
    });

    chatContainerEl.innerHTML = htmlMessageList;
};

const everySecond = () => {
    // Refresh messages every second
    setInterval(refreshMessages, 5000);
};

document.addEventListener("DOMContentLoaded", refreshMessages);
document.addEventListener("DOMContentLoaded", everySecond);


// ================================ //
// === Async submit new message === //
// ================================ //


const newMessageFormEl = document.querySelector("#addNewMessage");

newMessageFormEl.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Get the message
    const replyValue = newMessageFormEl.reply.value;

    // Get the date
    const dateValue = new Date().toISOString();

    // Add the message to the database
    const { data, error } = await AsyncRouter.post("post-message", { replyValue, dateValue });

    // Create a new paragraph element with the user data
    const newMessageEl = document.createElement("div");
    newMessageEl.classList.add("rounded-box");

    if (data) {
        // Destructure the data
        const { username, message, date } = data;

        // Format the date and time
        const dateFormat = new Date(date).toLocaleDateString("fr-FR", { day: 'numeric', month: 'short' });
        const timeFormat = new Date(date).toLocaleTimeString("fr-FR", { hour: '2-digit', minute: '2-digit' });

        // Create the new message content
        const content =
            `<div class="flex flex-row justify-between">
                <h3>${username}</h3>
                <div class="flex flex-row items-center gap-1">
                    <p>${dateFormat}</p>
                    <p>•</p>
                    <p>${timeFormat}</p>
                </div>
            </div>
            <p>${message}</p>`;

        newMessageEl.innerHTML = content;
    } else {
        newMessageEl.innerHTML = error;
    }

    // Add the new message to the chat container
    chatContainerEl.appendChild(newMessageEl);

    // Auto scroll to the bottom
    autoScrollNewMessage();

    // Clear the input
    newMessageFormEl.reply.value = "";
});


// =========================== //
// === Auto scroll feature === //
// =========================== //


const autoScrollOnLoad = () => {
    chatContainerEl.scrollTop = chatContainerEl.scrollHeight;
};

const autoScrollNewMessage = () => {
    chatContainerEl.scrollTo({
        top: chatContainerEl.scrollHeight,
        behavior: "smooth",
    });
};

document.addEventListener("DOMContentLoaded", autoScrollOnLoad);