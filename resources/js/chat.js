document.addEventListener("DOMContentLoaded", function () {
    const chatInput = document.getElementById("chat-input");
    const chatMessages = document.getElementById("chat-messages");
    const sendMessageButton = document.getElementById("send-message");

    sendMessageButton.addEventListener("click", function () {
        axios
            .post("/chat/send", {
                message: chatInput.value,
            })
            .then((response) => {
                chatInput.value = "";
            })
            .catch((error) => {
                console.error(error);
            });
    });

    window.Echo.private("chat").listen("MessageSent", (e) => {
        const messageElement = document.createElement("li");
        messageElement.innerHTML = `<strong>${e.chatMessage.user.name}:</strong> ${e.chatMessage.message}`;
        chatMessages.appendChild(messageElement);
    });
});
