<div>
    <h2>AGGIUNTA NUOVO CORSO</h2>
</div>
<form action="#" method="POST" class="new-course" id="courseForm">
    <label for="name-new-course">Corso: 
        <input type="text" id="name-new-course" name="name-new-course" placeholder="Nome Corso"></label>
    <button onclick="openPopupToAddCourse(event); return false;"
    type="submit" id="btn-new-course" name="btn-new-course">Aggiungi</button>
</form>
<form action="#" method="POST" class="delete-course" id="courseForm">
    <label for="course">Seleziona corso da eliminare: <select name="course-to-delete" id="course-to-delete">
        <option value="" disabled selected hidden>seleziona corso</option>
            <?php foreach($templateParams["courses"] as $course): ?>
            <option value="<?php echo $course["nome"] ?>"><?php echo $course["nome"] ?></option>
            <?php endforeach; ?>
    </select></label>
    <button onclick="openSafetyPopup(event); return false;"
    type="submit" id="btn-delete-course" name="btn-delete-course">Elimina</button>
</form>

<div id="coursePopup" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="coursePopupObject">placeholder</h2>
        <p id="coursePopupText"></p>
        <div class="popup-buttons">
            <button id="chiudi">Chiudi</button>
        </div>
    </div>
</div>

<div id="safetyPopup" class="hidden-popup">
            <div class="popup-elements">
                <h2 id="safetyPopupObject">placeholder</h2>
                <p id="safetyPopupText"></p>
                <div class="popup-buttons">
                    <button id="undo">Annulla</button>
                    <button id="confirm">Procedi</button>
                </div>
            </div>
        </div>