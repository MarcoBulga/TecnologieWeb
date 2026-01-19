const menu = document.getElementById('menu');
const notifiche = document.getElementById('notifiche');
const btnChiudiNotifiche = document.getElementById('chiudi-notifiche');
const btnChiudiMenu = document.getElementById('chiudi-menu');
const btnMenu = document.getElementById('bottone-menu');
const btnNotifiche = document.getElementById('bottone-notifiche');

btnChiudiMenu.addEventListener('click', function() {
    menu.classList.remove('show');
});

btnChiudiNotifiche.addEventListener('click', function() {
    notifiche.classList.remove('show');
});

btnMenu.addEventListener('click', function() {
    menu.classList.add('show');
});

btnNotifiche.addEventListener('click', function() {
    notifiche.classList.add('show');
});

function deleteNotification(notification){
    if(notification){
        notification.classList.add('fade-out');
        setTimeout(() => {
            notification.remove();

            const remaining = notifiche.querySelectorAll('.notification');
            if(remaining.length === 0){
                notifiche.classList.remove('show');
            }

        }, 500)
    }
}

//popup notifica
function openMessage(notification, type, text){
    const bottoneCliccato = event.target.closest('.elimina-notifica');
    if(bottoneCliccato){
        const notificaDaEliminare = bottoneCliccato.closest('.notification');
        deleteNotification(notificaDaEliminare);
        return;
    }
    
    let popup;
    if(type === "messaggio"){
        popup = document.getElementById("notificationPopup");
    } else if(type === "richiesta"){
        popup = document.getElementById("notificationPopupRequest");
    } else {
        alert("Errore nell'apertura della notifica (type = null)");
    } 
    
    //const popup = document.getElementById("notificationPopup");
    const object = notification.querySelector("p:nth-of-type(1)");
    const sender = notification.querySelector("p:nth-of-type(2)");
    const popupObject = popup.querySelector("h2:nth-of-type(1)");
    const popupText = popup.querySelector("p:nth-of-type(1)");
    const popupSender = popup.querySelector("p:nth-of-type(2)");

    popupObject.textContent = object.textContent;
    popupText.textContent = text;
    popupSender.textContent = sender.textContent;
    

    popup.style.display = "flex";

    popup.querySelector("button:nth-of-type(1)").onclick = function(){

        deleteNotification(notification);

        popup.style.display = "none";
    };
}

document.addEventListener('click', function(event){
    //--- MENU ---
    if(menu.classList.contains('show')){
        const clickInsideMenu = menu.contains(event.target);
        const clickInsideMenuButton = btnMenu.contains(event.target);

        const popupNormal = document.getElementById("notificationPopup");
        const popupRequest = document.getElementById("notificationPopupRequest");

        let clickInsidePopup = false;
        [popupNormal, popupRequest].forEach(popup => {
            if(popup && popup.contains(event.target)) {
                clickInsidePopup = true;
            }
        });

        if(!clickInsideMenu && !clickInsideMenuButton && !clickInsidePopup){
            menu.classList.remove('show');
        }
    }

    //--- NOTIFICHE ---
    if(notifiche.classList.contains('show')){
        const clickInsideNotification = notifiche.contains(event.target);
        const clickInsideNotificationButton = btnNotifiche.contains(event.target);

        const popupNormal = document.getElementById("notificationPopup");
        const popupRequest = document.getElementById("notificationPopupRequest");

        let clickInsidePopup = false;
        [popupNormal, popupRequest].forEach(popup => {
            if(popup && popup.contains(event.target)){
                clickInsidePopup = true;
            }
        });

        if(!clickInsideNotification && !clickInsideNotificationButton && !clickInsidePopup){
            notifiche.classList.remove('show');
        }
    }
})
