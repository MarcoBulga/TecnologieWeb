// --- CREAZIONE GRUPPI ---
// Fa in modo che il nuemero dei partecipanti rimanga tra 1 e 6 alla creazione del gruppo
document.addEventListener("DOMContentLoaded", function(){
    const groupSize = document.getElementById("groupsize");

    if (groupSize) {
        groupSize.addEventListener("input", function(){
            let v = parseInt(this.value);

            if(v > 6) this.value = 6;
            if(v < 1) this.value = 1;
        });

        // Cambio con le freccette
        groupSize.addEventListener("change", function(){
            let v = parseInt(this.value);

            if(isNaN(v)){
                this.value = 1;
            } else if(v > 6){
                this.value = 6;
            } else if(v < 1){
                this.value = 1;
            }
        });
    }
});

//Popup per successo
function successPopup(string,event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("popupConfirm");
    const text = document.getElementById("popupTextConfirm");

    text.textContent = string;

    popup.style.display = "flex";

    document.getElementById("chiudiConfirm").onclick = function(){
        popup.style.display = "none";
        location.reload();
    };
}

// --- VISUALIZZAZIONE GRUPPI ---
function openPopupRequestToJoin(groupName,idGruppo){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");

    text.textContent = "Sei sicuro di volerti unire a " + groupName + "?";

    popup.style.display = "flex";

    document.getElementById("yes").onclick = async function(){
        const url = "gestisci-richiesta.php?idGruppo=" + idGruppo + "&action=join";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella richiesta" + response.status);
            }
            const data = await response.json();
            if(data['esito']) {
                window.location.href= "./specific-group-to-see.php?idGruppo=" + idGruppo + "&status=success_join";
            } else {
                alert("Errore nell'unirsi al gruppo")
            }
        } catch (error) {
            console.error("Errore durante la richiesta: ", error.message);
        }

        popup.style.display = "none";
    };

    document.getElementById("not").onclick = function(){
        popup.style.display = "none";
    };
}

function openPopupRequestToJoinPrivate(groupName,idGruppo){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");
    const richiesta = document.getElementById("richiesta");
    const oggetto = document.getElementById("oggetto");

    text.textContent = "Il gruppo è privato! Sei sicuro di voler chiedere di unirti a " + groupName + "? Scrivi qualcosa:";

    popup.style.display = "flex";

    

    document.getElementById("yes").onclick = async function(event){
        const url = "gestisci-richiesta.php?idGruppo=" + idGruppo +"&richiesta=" + richiesta.value.trim() + "&oggetto=" + oggetto.value.trim() + "&action=join-private";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella richiesta" + response.status);
            }
            const data = await response.json();
            if(data['esito']) {
                popup.style.display = "none";
                successPopup("Richiesta inviata con successo!",event);
            }
        } catch (error) {
            console.error("Errore durante la richiesta: ", error.message);
        }
    };


    document.getElementById("not").onclick = function(){
        popup.style.display = "none";
    };
}

function openPopupReport(){
    const popup = document.getElementById("popupReport");
    const header = document.getElementById("popupHeaderReport");
    const testo = document.getElementById("popupTextReport");
    const oggetto = document.getElementById("popupObjectReport");

    header.textContent = "SEGNALAZIONE:";

    popup.style.display = "flex";

    document.getElementById("conferma").onclick = async function(){
        const url = "gestisci-segnalazione.php?&testo=" + testo.value.trim() + "&oggetto=" + oggetto.value.trim() + "&action=report";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella richiesta" + response.status);
            }
            const data = await response.json();
            console.log(data);
            if(data['esito']) {
                openPopupConfirm();
            } else {
                alert("Errore nell'unirsi al gruppo")
            }
        } catch (error) {
            console.error("Errore durante la richiesta: ", error.message);
        }

        popup.style.display = "none";
    };

    document.getElementById("annulla").onclick = function(){
        popup.style.display = "none";
        location.reload();
    };
}

function openPopupToLeave(idGruppo){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");

    text.textContent = "Sei sicuro di voler uscire dal gruppo?";

    popup.style.display = "flex";

    document.getElementById("yes").onclick = async function(){
        const url = "gestisci-richiesta.php?idGruppo=" + idGruppo + "&action=leave";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella richiesta" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                window.location.href = "./specific-group-to-see.php?idGruppo=" + idGruppo + "&status=success_leave";
            } else {
                alert("Errore nell'uscita dal gruppo");
            }
        } catch (error) {
            console.error("Errore durante la richiesta:", error.message);
        }

        popup.style.display = "none";
    };

    document.getElementById("not").onclick = function(){
        popup.style.display = "none";
    };
}

function openPopupToDeleteGroup(idGruppo,admin){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");

    text.textContent = "Sei sicuro di voler eliminare il gruppo?";

    popup.style.display = "flex";

    document.getElementById("yes").onclick = async function(){
        const url = "gestisci-richiesta.php?idGruppo=" + idGruppo + "&action=delete_group";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nell'eliminazione del gruppo" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                if(admin == true) {
                    window.location.href = "./search.php?&status=success_leave";
                }else {
                    window.location.href = "./user-groups.php?&status=success_leave";
                }
            } else {
                alert("Errore nell'eliminazione del gruppo");
            }
        } catch (error) {
            console.error("Errore durante l'eliminazione del gruppo:", error.message);
        }

        popup.style.display = "none";
    };

    document.getElementById("not").onclick = function(){
        popup.style.display = "none";
    };
}

function openPopupToDeleteReport(button) {
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupTextReport");

    const idNotifica = button.dataset.idnotifica;

    text.textContent = "Sei sicuro di voler eliminare la segnalazione n." + idNotifica + " ?";

    popup.style.display = "flex";

    document.getElementById("yesReport").onclick = async function(){
        const url = "gestisci-segnalazione.php?idNotifica=" + idNotifica + "&action=delete";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella richiesta" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                window.location.href = "./reports.php?status=success_leave";
            } else {
                alert("Errore nella cancellazione della segnalazione");
            }
        } catch (error) {
            console.error("Errore durante la cancellazione della segnalazione:", error.message);
        }

        popup.style.display = "none";
    };

    document.getElementById("noReport").onclick = function(){
        popup.style.display = "none";
    };
}

async function openPopupToAddCourse(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("coursePopup");
    const text = document.getElementById("coursePopupText");
    const object = document.getElementById("coursePopupObject");
    const name = document.getElementById("name-new-course").value;

    if(name !== "") {
        const url = "gestisci-course-change.php?nomeCorso=" + name + "&action=add_course";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella creazione del corso" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                object.textContent = "Corso aggiunto";
                text.textContent = "Il corso da te aggiunto è ora visibile a tutti gli utenti";

                popup.style.display= "flex";

            } else {
                object.textContent = "Aggiunta corso fallita!"
                text.textContent = "Probabilmente esiste già un corso con quel nome, non possono essercene due uguali!"

                popup.style.display = "flex";
            }
        } catch (error) {
            console.error("Errore durante l'aggiunta del corso:", error.message);
        }

        document.getElementById("chiudi").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };
    }
}

async function openPopupToDeleteCourse(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("coursePopup");
    const text = document.getElementById("coursePopupText");
    const object = document.getElementById("coursePopupObject");
    const name = document.getElementById("course-to-delete").value;

    if (name !== "") {
        const url = "gestisci-course-change.php?nomeCorso=" + name + "&action=remove_course";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella cancellazione del corso" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                object.textContent = "Corso eliminato";
                text.textContent = "Il corso è stato eliminato con successo! Tutti i gruppi che facevano riferimento a quel corso sono stati rimossi!";

                popup.style.display= "flex";

            } else {
                object.textContent = "Eliminazione corso fallita!"
                text.textContent = "Purtroppo qualcosa sembra essere andato storto..."

                popup.style.display = "flex";
            }
        } catch (error) {
            console.error("Errore durante l'eliminazione del corso:", error.message);
        }

        document.getElementById("chiudi").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };
    }
}

async function openPopupToAddTag(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("tagPopup");
    const text = document.getElementById("tagPopupText");
    const object = document.getElementById("tagPopupObject");
    const name = document.getElementById("name-new-tag").value;

    if(name !== "") {
        const url = "gestisci-tag-change.php?nomeTag=" + name + "&action=add_tag";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella creazione del tag" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                object.textContent = "Tag aggiunto";
                text.textContent = "Il tag da te aggiunto è ora visibile a tutti gli utenti";

                popup.style.display= "flex";

            } else {
                object.textContent = "Aggiunta tag fallita!"
                text.textContent = "Probabilmente esiste già un tag con quel nome, non possono essercene due uguali!"

                popup.style.display = "flex";
            }
        } catch (error) {
            console.error("Errore durante l'aggiunta del tag:", error.message);
        }

        document.getElementById("chiudiTag").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };
    }
}

async function openPopupToDeleteTag(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("tagPopup");
    const text = document.getElementById("tagPopupText");
    const object = document.getElementById("tagPopupObject");
    const name = document.getElementById("tag-to-delete").value;

    if (name !== "") {
        const url = "gestisci-tag-change.php?nomeTag=" + name + "&action=remove_tag";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Errore nella cancellazione del tag" + response.status);
            }
            const data = await response.json();
            // Gestisci la risposta se necessario
            if(data["esito"]) {
                object.textContent = "Tag eliminato";
                text.textContent = "Il tag è stato eliminato con successo!";

                popup.style.display= "flex";

            } else {
                object.textContent = "Eliminazione tag fallita!"
                text.textContent = "Purtroppo qualcosa sembra essere andato storto..."

                popup.style.display = "flex";
            }
        } catch (error) {
            console.error("Errore durante l'eliminazione del tag:", error.message);
        }

        document.getElementById("chiudiTag").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };
    }
}

async function openSafetyPopupCourse(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("safetyPopupCourse");
    const text = document.getElementById("safetyPopupCourseText");
    const object = document.getElementById("safetyPopupCourseObject");
    const name = document.getElementById("course-to-delete").value;

    if (name !== "") {
        // Gestisci la risposta se necessario
        object.textContent = "Sei sicuro di procedere con l'eliminazione?";
        text.textContent = "Una volta che procedi con l'eliminazione del corso " + name + " tutti i gruppi che ne facevano riferimento saranno eliminati, sei sicuro/a di voler procedere?";

        popup.style.display = "flex";

        document.getElementById("undo").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };

        document.getElementById("confirm").onclick = function() {
            popup.style.display = "none";
            openPopupToDeleteCourse(event);
        }
    }
}

async function openSafetyPopupTag(event) {
    if (event) event.preventDefault();
    const popup = document.getElementById("safetyPopupTag");
    const text = document.getElementById("safetyPopupTagText");
    const object = document.getElementById("safetyPopupTagObject");
    const name = document.getElementById("tag-to-delete").value;

    if (name !== "") {
        // Gestisci la risposta se necessario
        object.textContent = "Sei sicuro di procedere con l'eliminazione?";
        text.textContent = "Una volta che procedi con l'eliminazione del tag " + name + " non sarà più possibile utilizzarlo";

        popup.style.display = "flex";

        document.getElementById("undoTag").onclick = function(){
            popup.style.display = "none";
            location.reload();
        };

        document.getElementById("confirmTag").onclick = function() {
            popup.style.display = "none";
            openPopupToDeleteTag(event);
        }
    }
}

function openPopupConfirm(){
    const popup = document.getElementById("popupConfirm");
    const text = document.getElementById("popupTextConfirm");

    text.textContent = "La segnalazione è stata inviata con successo!"

    popup.style.display = "flex";

    document.getElementById("chiudiConfirm").onclick = function() {
        popup.style.display = "none";
        location.reload();
    }
}