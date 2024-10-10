let deleteUserButton = document.querySelector("#deleteUser");
let inputUser = document.querySelector("#inputUsername");
// let username;
let ajax = document.querySelector("#ajax");

// //Add the click event listener to the deleteUserButton
deleteUserButton.addEventListener("click", deleteUser);

function deleteUser() {
    user = inputUser.value;
    // console.log(username);
    fetch("async/delete_user.php?username=" + user, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
        //body: JSON.stringify({ username: user }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            ajax.innerHTML = data.message;
            ajax.innerHTML += data.update;

        })
        .catch((error) => {
            console.error(error);
        });
}