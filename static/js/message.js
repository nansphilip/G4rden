const chatContainerEl = document.querySelector("#directChat");

const autoScrollOnLoad = () => {
    chatContainerEl.scrollTop = chatContainerEl.scrollHeight;
}

const autoScrollNewMessage = () => {
    chatContainerEl.scrollTo({
        top: chatContainerEl.scrollHeight,
        behavior: "smooth",
        
    });
};

document.addEventListener("DOMContentLoaded", autoScrollOnLoad);