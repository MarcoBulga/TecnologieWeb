const menu = document.getElementById('menu');
const notifiche = document.getElementById('notifiche');
const btnChiudiNotifiche = document.getElementById('chiudi-notifiche');
const btnChiudiMenu = document.getElementById('chiudi-menu');
const btnMenu = document.getElementById('bottone-menu');
const btnNotifiche = document.getElementById('bottone-notifiche');

btnChiudiMenu.addEventListener('click', function() {
    menu.classList.remove('show');
})

btnChiudiNotifiche.addEventListener('click', function() {
    notifiche.classList.remove('show');
})

btnMenu.addEventListener('click', function() {
    menu.classList.add('show');
})

btnNotifiche.addEventListener('click', function() {
    notifiche.classList.add('show');
})

function deleteNotification(notification){
    if(notification){
        notification.classList.add('fade-out');
        setTimeout(() => {
            notification.remove();
        }, 500)
    }
}

//per rimuovere le notifiche
notifiche.addEventListener('click', function(event) {
    const bottoneCliccato = event.target.closest('.elimina-notifica');
    if (bottoneCliccato) {
        const notificaDaEliminare = bottoneCliccato.closest('.notification');
        deleteNotification(notificaDaEliminare);
    }
});

//popup notifica
function openMessage(notification){
    const popup = document.getElementById("notificationPopup");
    const object = notification.querySelector("#object");
    const text = "Lorem ipsum dolor sit amet";
    const sender = notification.querySelector("#sender");
    const popupObject = document.getElementById("popupObject");
    const popupText = document.getElementById("popupText");
    const popupSender = document.getElementById("popupSender");

    popupObject.textContent = object.textContent;
    popupText.textContent = text;
    popupSender.textContent = sender.textContent;
    

    popup.style.display = "flex";

    document.getElementById("no").onclick = function(){

        deleteNotification(notification);

        popup.style.display = "none";
    };
}

function openRequest(notification){
    const popup = document.getElementById("notificationPopupRequest");
    const object = notification.querySelector("#object");
    const text = "Lorem ipsum dolor sit amet";
    const sender = notification.querySelector("#sender");
    const popupObject = document.getElementById("popupObjectRequest");
    const popupText = document.getElementById("popupTextRequest");
    const popupSender = document.getElementById("popupSenderRequest");

    popupObject.textContent = object.textContent;
    popupText.textContent = text;
    popupSender.textContent = sender.textContent;
    

    popup.style.display = "flex";

    const buttonNO = popup.querySelector("#noRequest");
    const buttonYES = popup.querySelector("#yesRequest");

    document.getElementById("noRequest").onclick = function(){

        deleteNotification(notification);

        popup.style.display = "none";
    };

    document.getElementById("yesRequest").onclick = function(){
        alert("Richiesta inviata");
        deleteNotification(notification);

        popup.style.display = "none";
    }
}