import AsyncRouter from "/static/js/AsyncRouter.js";

const sendData = async (event) => {
    event.preventDefault();

    const formValues = {
        username: event.target.querySelector("input#username").value,
        firstname: event.target.querySelector("input#firstname").value,
        lastname: event.target.querySelector("input#lastname").value,
    };

    try {
        const { data, error } = await AsyncRouter.post("put-profile", formValues);

        if (!data) {
            throw new Error(error);
        }

        alert(`Update success: ${data}`);
    } catch (error) {
        alert(error);
    }
};

document.addEventListener("submit", (event) => sendData(event));
