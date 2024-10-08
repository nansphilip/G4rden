import AsyncRouter from "/static/js/AsyncRouter.js";

// ====================================== //
// ===== Async functions with wait  ===== //
// ====================================== //
function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function clearMessage(element) {
    await wait(4000);
    element.innerHTML = "";
}

async function deleteElement(element){
    await wait(4000);
    element.remove();
}

// ========================== //
// ===== Delete a user  ===== //
// ========================== //
export const deleteUser = async () => {
    //Point to the username input field and affect its value to the variable username
    let inputUser = document.querySelector("#inputUsername");
    let username = inputUser.value;

    // Delete the user by its username
    const { message, error } = await AsyncRouter.post("delete-user", {username});

    //Point to the div ajax to show the data message
    let ajax = document.querySelector("#ajax");
    if(message){
        ajax.innerHTML = message;
    } else {
        ajax.innerHTML = "error : " + error;
    }
};

// Add button listener, to execute the function
const buttonDelete = document.querySelector("#deleteUser");
buttonDelete.addEventListener("click", async () => await deleteUser());

// ========================== //
// ==== Delete a message ==== //
// ========================== //

export const showAllMessages = async () => {
    //Point to the form fields and gets their value
    let inputUser = document.querySelector("#usernameMessage");
    let usernameAuthor = inputUser.value;
    let inputMsg = document.querySelector("#inputMessage");
    let keyMessage = inputMsg.value;
    let messageContainer = document.querySelector("#messages-container");
    
    //Calls ajax router to get the messages corresponding with the key search
    const { message, data, error } = await AsyncRouter.post("search-and-destroy-message", {usernameAuthor, keyMessage});

    
    //Affect the returned message to the div if error
    if(!message){
        messageContainer.innerHTML = "error: " + error;
        //Wait 5 secondes then clear the message
        clearMessage(messageContainer);
        return;
    }

    //Delete the former messages in the container
    if(messageContainer.hasChildNodes()){
        messageContainer.innerHTML = "";
    }

    //For all messages, create new element with the message content
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

        // Add the new message to the chat container
        messageContainer.appendChild(newMessageDiv);

        //Add event listener to delete message content
        const deleteMessage = document.querySelector("#delete-" + idMessage);
        deleteMessage.addEventListener("click", async () => await deleteMessageContent(idMessage));
    }
}

//Add button listener 
const buttonSearch = document.querySelector("#searchMessage");
buttonSearch.addEventListener("click", async () => await showAllMessages());

// =================================== //
// ===== Delete a message content ==== //
// =================================== //

export const deleteMessageContent = async (idMessage) => {
    const messageContainer = document.querySelector("#messages-container");

    // Delete the message by its id
    const { message, error } = await AsyncRouter.post("delete-message", {idMessage});

    //If error in php file print error in container
    if(!message){
        return (messageContainer.innerHTML = "error: " + error)
    }

    //Clear the message in container
    const messageDiv = document.querySelector("#message-" + idMessage);
    messageDiv.innerHTML = message;
    //Wait 5 secondes then delete the element message
    deleteElement(messageDiv);
}

