<h2>CREA GRUPPO</h2>
    <form action="#" method="post">
        <ul>
            <li><label for="course">Seleziona corso : <select name="course" >
                <option value="NULL">seleziona corso</option>
                <option value="Tecnologie Web">Tecnologie Web</option>
            </select></label></li>
            <li><label for="groupname">Inserire nome gruppo : <input type="text" name="groupname" id="groupname" required /></label></li>
            <li><label for="groupsize">Numero partecipanti : <input type="number" id="groupsize" name="groupsize" value="1" min="1" max="6" required /></label></li>
            <li>
                <p>Tag del gruppo : </p><br/>
                <button id="tagbutton" name="tagbutton">Scegli tag</button>
            </li>
            <li><label for="private">Privato <input type="checkbox" name="private" id="private" /></label></li>
            <li><label for="shortdescription">Descrizione breve : <br/><textarea name="shortdescription" id="shortdescription" required></textarea></li>
            <li><label for="longdescription">Descrizione estesa : <br/><textarea name="longdescription" id="longdescription" required></textarea></li>
        </ul>
        <input type="reset" id="undobutton" name="undobutton" value="Annulla" />
        <input type="submit" id="confirmbutton" name="confirmbutton" value="Conferma"/>
        <?php
            $value = false;
            if(isset($_POST['confirmbutton']) && empty($_POST['undobutton'])) {
                $value = $dbh -> createNewGroup($_POST['groupname'], $_POST['course'], $_POST['groupsize'], 
                               isset($_POST['private']) ? 1 : 0, $_POST['shortdescription'], $_POST['longdescription']);
            }
            if($value) {
                echo "<p>Gruppo creato con successo!</p>";
            } else {
                echo "<p>Errore nella creazione del gruppo.</p>";
            }
        ?>
    </form>
        