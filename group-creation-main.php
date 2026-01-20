<h2>CREA GRUPPO</h2>
    <form action="#" method="post">
        <ul>
            <li><label for="course">Seleziona corso : <select name="course" id="course" required>
                <option value="" disabled selected hidden>seleziona corso</option>
                <?php foreach($templateParams["courses"] as $course): ?>
                <option value="<?php echo $course["nome"] ?>"><?php echo $course["nome"] ?></option>
                <?php endforeach; ?>
            </select></label></li>
            <li><label for="groupname">Inserire nome gruppo : <input type="text" name="groupname" id="groupname" required /></label></li>
            <li><label for="groupsize">Numero partecipanti : <input type="number" id="groupsize" name="groupsize" value="1" min="1" max="6" required /></label></li>
            <li>
                <p>Tag del gruppo : </p><br/>
                <button type="button" id="tag-button" name="tag-button">Scegli tag</button>
            </li>
            <li><label for="private">Privato <input type="checkbox" name="private" id="private" /></label></li>
            <li><label for="shortdescription">Descrizione breve : </label><br/><textarea name="shortdescription" id="shortdescription" required></textarea></li>
            <li><label for="longdescription">Descrizione estesa : </label><br/><textarea name="longdescription" id="longdescription" required></textarea></li>
        </ul>
        <div class="filters">
            <ul>
                <?php foreach($templateParams["filters"] as $filter): 
                    $safeId = stringToId($filter["nome"])
                    ?>
                <li><label for="<?php echo $safeId; ?>"><input type="checkbox" id="<?php echo $safeId; ?>" name="<?php echo $safeId; ?>"><?php echo $filter["nome"]; ?></label></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <input type="reset" id="undobutton" name="undobutton" value="Annulla" />
        <input type="submit" id="confirmbutton" name="confirmbutton" value="Conferma" />
        <?php
            $valueGroup = false;
            if(isset($_POST['confirmbutton']) && empty($_POST['undobutton'])) {
                $selectedFilters = array();
                foreach($templateParams["filters"] as $filter) {
                    if(isset($_POST[stringToId($filter["nome"])])) {
                        $selectedFilters[] = $filter["nome"];
                    }
                }
                $valueGroup = $dbh -> createNewGroup($_POST['groupname'], $_POST['course'], $_POST['groupsize'], 
                               isset($_POST['private']) ? 1 : 0, $_POST['shortdescription'], $_POST['longdescription'],$selectedFilters);
                if($valueGroup) {
                    echo "<p>Gruppo creato con successo!</p>";
                } else {
                    echo "<p>Errore nella creazione del gruppo.</p>";
                }
            }
        ?>
    </form>
        