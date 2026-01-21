const btn = document.getElementById("chat-btn");
const chat = document.querySelector("section#chat");

btn.addEventListener('click', function(){
    chat.classList.toggle('show');
} );
