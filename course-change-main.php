<div>
    <h2>CORSI E TAG</h2>
</div>
<div class="forms-row">
    <form action="#" method="POST" class="new-course" id="courseForm">
        <label for="name-new-course">Corso: 
            <input type="text" id="name-new-course" name="name-new-course" placeholder="Nome Corso"></label>
        <button onclick="openPopupToAddCourse(event); return false;"
        type="submit" id="btn-new-course" name="btn-new-course">Aggiungi</button>
    </form>

    <form action="#" method="POST" class="new-tag" id="tagCreation">
        <label for="name-new-tag">Tag: 
            <input type="text" id="name-new-tag" name="name-new-tag" placeholder="Nome Tag"></label>
        <button onclick="openPopupToAddTag(event); return false;"
        type="submit" id="btn-new-tag" name="btn-new-tag">Aggiungi</button>
    </form>
</div>

<div class="forms-row">
    <form action="#" method="POST" class="delete-course" id="courseForm">
        <label for="course">Seleziona corso da eliminare: <select name="course-to-delete" id="course-to-delete">
            <option value="" disabled selected hidden>seleziona corso</option>
                <?php foreach($templateParams["courses"] as $course): ?>
                <option value="<?php echo $course["nome"] ?>"><?php echo $course["nome"] ?></option>
                <?php endforeach; ?>
        </select></label>
        <button onclick="openSafetyPopupCourse(event); return false;"
        type="submit" id="btn-delete-course" name="btn-delete-course">Elimina</button>
    </form>

    <form action="#" method="POST" class="delete-tag" id="courseForm">
        <label for="course">Seleziona tag da eliminare: <select name="tag-to-delete" id="tag-to-delete">
            <option value="" disabled selected hidden>seleziona tag</option>
                <?php foreach($templateParams["tags"] as $tag): ?>
                <option value="<?php echo $tag["nome"] ?>"><?php echo $tag["nome"] ?></option>
                <?php endforeach; ?>
        </select></label>
        <button onclick="openSafetyPopupTag(event); return false;"
        type="submit" id="btn-delete-tag" name="btn-delete-tag">Elimina</button>
    </form>
</div>

<div id="coursePopup" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="coursePopupObject">placeholder</h2>
        <p id="coursePopupText"></p>
        <div class="popup-buttons">
            <button id="chiudi">Chiudi</button>
        </div>
    </div>
</div>

<div id="tagPopup" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="tagPopupObject">placeholder</h2>
        <p id="tagPopupText"></p>
        <div class="popup-buttons">
            <button id="chiudiTag">Chiudi</button>
        </div>
    </div>
</div>

<div id="safetyPopupCourse" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="safetyPopupCourseObject">placeholder</h2>
        <p id="safetyPopupCourseText"></p>
        <div class="popup-buttons">
            <button id="undo">Annulla</button>
            <button id="confirm">Procedi</button>
        </div>
    </div>
</div>

<div id="safetyPopupTag" class="hidden-popup">
    <div class="popup-elements">
        <h2 id="safetyPopupTagObject">placeholder</h2>
        <p id="safetyPopupTagText"></p>
        <div class="popup-buttons">
            <button id="undoTag">Annulla</button>
            <button id="confirmTag">Procedi</button>
        </div>
    </div>
</div>