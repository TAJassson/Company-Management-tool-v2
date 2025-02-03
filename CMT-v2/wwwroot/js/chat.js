"use strict";

var connection = new signalR.HubConnectionBuilder().withUrl("/chatHub").build();

// Disable the send button until connection is established.
document.getElementById("sendButton").disabled = true;

connection.on("ReceiveMessage", function (message) {
    var li = document.createElement("li");
    li.textContent = message;
    document.getElementById("messagesList").appendChild(li);
});

connection.start().then(function () {
    document.getElementById("sendButton").disabled = false;

    // Send a welcome message when the connection is established
    var user = "System";
    connection.invoke("SendMessage", user, welcomeMessage).catch(function (err) {
        console.error(err.toString());
    });
}).catch(function (err) {
    console.error(err.toString());
});

document.getElementById("sendButton").addEventListener("click", function (event) {
    var user = "User";
    var messageInput = document.getElementById("messageInput");
    var message = messageInput.value.trim(); // Trim leading and trailing whitespaces

    if (message !== "") {
        let nameReceived = false; // Flag to track if name is received

        switch (true) {
            case message.toLowerCase().includes("buy"):
                // Send the original message
                connection.invoke("SendMessage", user, message).catch(function (err) {
                    console.error(err.toString());
                });

                // Send a message asking for the name
                connection.invoke("SendMessage", user, "System: Please enter your name").catch(function (err) {
                    console.error(err.toString());
                });

                // Listen for the user's name
                connection.on("ReceiveMessage", () => {
                    if (!nameReceived && name !== "" && name !== "System: Please enter your name") {
                        // Greet the user if a name is provided
                        connection.invoke("SendMessage", user, "System: Hi " + name).catch(function (err) {
                            console.error(err.toString());
                        });
                        nameReceived = true;
                    }
                });

                break;

            case message.toLowerCase().includes("check"):
                // Send the original message
                connection.invoke("SendMessage", user, message).catch(function (err) {
                    console.error(err.toString());
                });

                // Send an additional test message for checking orders
                connection.invoke("SendMessage", user, "System: Test - Check order").catch(function (err) {
                    console.error(err.toString());
                });

                break;

            default:
                // Send the original message
                connection.invoke("SendMessage", user, message).catch(function (err) {
                    console.error(err.toString());
                });

                break;
        }

        messageInput.value = ""; // Clear the input field after sending the message
    } else {
        alert("Please enter a message before sending.");
    }

    event.preventDefault();
});

// Function to check user input before sending
function checkUserInput() {
    var message = document.getElementById("messageInput").value.trim(); // Trim leading and trailing whitespaces

    if (message === "") {
        alert("Please enter a message before sending.");
        return false; // Return false to prevent form submission
    }

    return true; // Return true if input is valid
}