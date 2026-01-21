const btn = document.getElementById("chat-btn");
const chat = document.querySelector("section#chat");
const send = document.getElementById("send-btn");
const message = document.getElementById("chat-message");
const messageZone = document.getElementById("messages-container");

btn.addEventListener('click', function(){
    chat.classList.toggle('show');
    messageZone.scrollTop = messageZone.scrollHeight;
} );

function constructMessage(text,name,surname) {
    let message = `<div class="message">
                <h5>` + name + " " + surname + ` </h5>
                <p>` + text + `</p>
            </div>`;
    return message;
}

async function sendMessage() {
    let text = message.value;
    if(text.trim() != "") {
        const id = window.location.href.split('?')[1].replace(/\D/g, "");

        const url = 'gestisci-chat.php?text='+ encodeURIComponent(text) + '&id='+id;
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.json();
            console.log(json);
            if(json["esito"]){
                messageZone.innerHTML += constructMessage(text,json["name"],json["surname"]);
                messageZone.scrollTop = messageZone.scrollHeight;
            } else {
                console.log("Errore cabbio");
            }

        } catch (error) {
            console.log(error.message);
        }
    }
}

message.addEventListener('keydown',function(event) {
    if(event.key === 'Enter') {
        event.preventDefault();
        sendMessage();
        message.value = "";
    }
});

send.addEventListener('click',function (event) {
    event.preventDefault();
    sendMessage();
    message.value = "";
})

