import AsyncRouter from "/static/js/async-router.js";

const chatContainerEl = document.querySelector("#directChat");

// ============================== //
// === Async refresh messages === //
// ============================== //

const refreshMessages = async () => {
    // Get the messages
    const { data, error } = await AsyncRouter.get("message");

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
    setInterval(refreshMessages, 1000);
};

document.addEventListener("DOMContentLoaded", refreshMessages);
document.addEventListener("DOMContentLoaded", everySecond);

// ================================ //
// === Async submit new message === //
// ================================ //






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