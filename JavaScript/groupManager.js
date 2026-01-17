// --- CREAZIONE GRUPPI ---
// Fa in modo che il nuemero dei partecipanti rimanga tra 1 e 6 alla creazione del gruppo
document.addEventListener("DOMContentLoaded", function(){
    const groupSize = document.getElementById("groupsize");

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
});

// --- VISUALIZZAZIONE GRUPPI ---
// Fa apparire il pop up di conferma quando si prova ad unirsi a un gruppo
function askConfirmation(){
    let groupName = document.getElementById("groupname").textContent;
    let answer = confirm("ATTENZIONE! Sei sicuro di volerti unire a " + groupName + "?");

    if(answer) {
        alert("Richiesta inviata");
    }
}