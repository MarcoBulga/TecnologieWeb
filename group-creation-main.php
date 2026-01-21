<h2>CREA GRUPPO</h2>
<form action="#" method="post" id="formCreaGruppo">
    <ul>
        <li><label for="course">Seleziona corso : <select name="course" id="course" required>
            <option value="" disabled selected hidden>seleziona corso</option>
            <?php foreach($templateParams["courses"] as $course): ?>
            <option value="<?php echo $course["nome"] ?>"><?php echo $course["nome"] ?></option>
            <?php endforeach; ?>
        </select></label></li>
        <li><label for="groupname">Inserire nome gruppo : <input type="text" name="groupname" id="groupname" required /></label></li>
        <li><label for="groupsize">Numero partecipanti : <input type="number" id="groupsize" name="groupsize" value="1" min="1" max="6" required /></label></li>
        <li><label for="private">Privato <input type="checkbox" name="private" id="private" /></label></li>
        <li>
            <p>Tag del gruppo : </p>
            <div class="filters">
                <ul>
                    <?php foreach($templateParams["filters"] as $filter): 
                        $safeId = stringToId($filter["nome"])
                        ?>
                    <li><label for="<?php echo $safeId; ?>"><input type="checkbox" id="<?php echo $safeId; ?>" name="<?php echo $safeId; ?>"><?php echo $filter["nome"]; ?></label></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </li>
        <li><label for="shortdescription">Descrizione breve : </label><br/><textarea name="shortdescription" id="shortdescription" required></textarea></li>
        <li><label for="longdescription">Descrizione estesa : </label><br/><textarea name="longdescription" id="longdescription" required></textarea></li>
    </ul>
    <button type="reset" id="undobutton" name="undobutton">Annulla</button>
    <button type="submit" id="confirmbutton" name="confirmbutton">Conferma</button>
</form>

<!--Popup di conferma-->
<div id="popupConfirmCreationGroup" class="hidden-popup">
    <div class="popup-elements">
        <p id="popupTextConfirmCreationGroup"></p>
        <div class="popup-buttons">
            <button id="not">No</button>
            <button id="yes">Si</button>
        </div>
    </div>
</div>
        