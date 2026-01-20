<div>
    <h2>AGGIUNTA NUOVO CORSO</h2>
</div>
<form action="#" method="POST" class="new-course" id="courseForm">
    <label for="name-new-course">Corso: 
        <input type="text" id="name-new-course" name="name-new-course" placeholder="Nome Corso"></label>
    <button onclick="openPopupToAddCourse(event); return false;"
    type="submit" id="btn-new-course" name="btn-new-course">Aggiungi</button>
</form>

<div id="addPopup" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="addPopupObject">placeholder</h2>
        <p id="addPopupText"></p>
        <div class="popup-buttons">
            <button id="chiudi">Chiudi</button>
        </div>
    </div>
</div>