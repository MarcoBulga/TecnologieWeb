const menu = document.getElementById('menu');
const notifiche = document.getElementById('notifiche');
const btnChiudiNotifiche = document.getElementById('chiudi-notifiche');
const btnChiudiMenu = document.getElementById('chiudi-menu');
const btnMenu = document.getElementById('bottone-menu');
const btnNotifiche = document.getElementById('bottone-notifiche');
const btnTag = document.getElementById("tag-button");
const filtersContainer = document.querySelector('form div.filters');

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

if(btnTag && filtersContainer) {
    btnTag.addEventListener('click', function(e) {
        e.preventDefault();
        console.log("Bottone cliccato correttamente");
        if (filtersContainer) {
            filtersContainer.classList.toggle('show');
            btnTag.classList.toggle('active');
            console.log("Classe 'show' aggiunta/rimossa");
        } else {
            console.error("Il contenitore .filters non è stato trovato");
        }

    })
}

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
function openMessage(notification, type, text, nomeGruppo){
    const bottoneCliccato = event.target.closest('.elimina-notifica');
    if(bottoneCliccato){
        const notificaDaEliminare = bottoneCliccato.closest('.notification');
        deleteNotification(notificaDaEliminare);
        return;
    }

    let popup;
    if(type === "messaggio"){
        //LOGICA PER MESSAGGI NORMALI
        popup = document.getElementById("notificationPopup");
        document.getElementById("popupObject").textContent = notification.querySelector("p:nth-of-type(1)").textContent;
        document.getElementById("popupText").textContent = text;
        document.getElementById("popupSender").textContent = notification.querySelector("p:nth-of-type(2)").textContent;
        document.getElementById("popupGroupNameMessage").textContent = nomeGruppo;

        //bottone chiudi messaggio
        document.getElementById("no").onclick = async function() {
            const idNotifica = notification.dataset.idnotifica;

            const url = './close-delete-message.php?action=delete&idNotifica=' + idNotifica;
            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.esito) {
                    deleteNotification(notification);
                    popup.style.display="none";
                } else {
                    alert("Errore: " + data.errore);
                }
            } catch (error) {
                console.error("Errore durante la chiusura del messaggio", error);
            }
        }
    } else if(type === "richiesta"){
        popup = document.getElementById("notificationPopupRequest");
        document.getElementById("popupObjectRequest").textContent = notification.querySelector("p:nth-of-type(1)").textContent;
        document.getElementById("popupTextRequest").textContent = text;
        document.getElementById("popupSenderRequest").textContent = notification.querySelector("p:nth-of-type(2)").textContent;
        document.getElementById("popupGroupNameRequest").textContent = nomeGruppo;

        //bottone accetta
        document.getElementById("yesRequest").onclick = async function() {
            const emailDaAggiungere = notification.dataset.mittente;
            const idGruppo = notification.dataset.idgruppo;
            const idNotificaOriginale = notification.dataset.idnotifica;

            if (!idGruppo || idGruppo === "") {
                console.error("Errore: ID Gruppo mancante nel dataset della notifica.");
                alert("Impossibile procedere: dati del gruppo non trovati.");
                return;
            }

            const url = 'accept-request.php?action=accept-request&email=' + emailDaAggiungere + '&idGruppo=' + idGruppo + '&idNotifica=' + idNotificaOriginale;
            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.esito) {
                    deleteNotification(notification);
                    popup.style.display="none";
                } else {
                    alert("Errore: " + data.errore);
                }
            } catch (error) {
                console.error("Errore durante l'accettazione", error);
            }
        }

        //bottone rifiuta
        document.getElementById("noRequest").onclick = async function() {
            const idNotificaDaEliminare = notification.dataset.idnotifica;

            const url = 'accept-request.php?action=deny-request&idNotifica=' + idNotificaDaEliminare;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.esito) {
                    deleteNotification(notification);
                    popup.style.display="none";
                } else {
                    alert("Errore: " + data.errore);
                }
            } catch (error) {
                console.error("Errore durante l'accettazione", error);
            }
            popup.style.display = "none";
        }
    } else {
        alert("Errore nell'apertura della notifica (type = null)");
    } 

    popup.style.display = "flex";

}

document.addEventListener('click', function(event){

    const menu = document.getElementById('menu');
    const btnMenu = document.getElementById('bottone-menu');
    const notifiche = document.getElementById('notifiche');
    const btnNotifiche = document.getElementById('bottone-notifiche');
    const chat = document.getElementById('chat');
    const btnChat = document.getElementById('chat-btn');

    const popupNormal = document.getElementById("notificationPopup");
    const popupRequest = document.getElementById("notificationPopupRequest");
    const popupReport = document.getElementById("popupReport");
    const popupConfirm = document.getElementById("popupConfirm");

    const isClickInsideAnyPopup = [popupNormal, popupRequest, popupReport, popupConfirm].some(
        popup => {
            return popup && popup.contains(event.target) && getComputedStyle(popup).display !== "none";
        }
    )
    //--- MENU ---
    if(menu.classList.contains('show')){

        const clickInsideMenu = menu.contains(event.target);
        const clickInsideMenuButton = btnMenu.contains(event.target);

        if(!clickInsideMenu && !clickInsideMenuButton && !isClickInsideAnyPopup) {
            menu.classList.remove('show');
        }
    }

    //--- NOTIFICHE ---
    if(notifiche.classList.contains('show')){

        const clickInsideNotifiche = notifiche.contains(event.target);
        const clickInsideNotificheButton = btnNotifiche.contains(event.target);

        if(!clickInsideNotifiche && !clickInsideNotificheButton && !isClickInsideAnyPopup) {
            notifiche.classList.remove('show');
        }
    }

    if (chat.classList.contains('show')) {
        const clickInsideChat = chat.contains(event.target);
        const clickInsideButtonChat = btnChat.contains(event.target);

        if(!clickInsideChat && !clickInsideButtonChat && !isClickInsideAnyPopup) {
            chat.classList.remove('show');
        }
    }
})
