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

// --- VISUALIZZAZIONE GRUPPI ---
function openPopupRequestToJoin(groupName){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");

    text.textContent = "Sei sicuro di volerti unire a " + groupName + "?";

    popup.style.display = "flex";

    document.getElementById("yes").onclick = function(){
        alert("Richiesta inviata");

        popup.style.display = "none";
    };

    document.getElementById("not").onclick = function(){
        popup.style.display = "none";
    };
}

function openPopupToLeave(idGruppo){
    const popup = document.getElementById("popup");
    const text = document.getElementById("popupText");

    text.textContent = "Sei sicuro di voler uscire dal gruppo?";

    popup.style.display = "flex";

    document.getElementById("yes").onclick = async function(){
        alert("Richiesta inviata");
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