<h2>GRUPPI DISPONIBILI</h2>
        <ul>
            <li>
                <label for="course">seleziona il corso</label>
                <select name="course" id="course" >
                    <?php foreach($templateParams["courses"] as $course): ?>
                    <option value="<?php echo $course["nome"] ;?>"><?php echo $course["nome"] ;?></option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li><button>filtri / tag</button></li>
            <li><label for="searchbar">barra di ricerca</label><input type="text" name="searchbar" id="searchbar" placeholder="barra di ricerca"/></label></li>
            <li><button id="searchbutton" name="searchbutton" >Cerca</button></li>
        </ul>
        <div class="filters">
            <ul>
                <?php foreach($templateParams["filters"] as $filter): ?>
                <li><label for=<?php echo $filter["nome"]; ?>><input type="checkbox" id=<?php echo $filter["nome"]; ?> name=<?php echo $filter["nome"]; ?>><?php echo $filter["nome"]; ?></label></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach($templateParams["Gruppi"] as $gruppo): ?>
        <section>
            <h3>
                <a href="./specific-group-to-join.php" class="link-header"><?php echo $gruppo['nome']; ?></a>
            </h3>
            <ul class="lista-componenti-gruppo">
                <?php $templateParams["Partecipants"] = $dbh->getPartecipants($gruppo['idGruppo']); ?>
                <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
                <li class="componente"><?php echo $partecipant['nome']." ".$partecipant['cognome']. " - ".$partecipant['email']; ?></li>
                <?php endforeach; ?>
            </ul>
            <p>Descrizione: <?php echo $gruppo['descr_breve']; ?> </p>
            <p>Corso: <?php echo $gruppo['corso_di_riferimento']; ?> </p>
            <?php if (isset($templateParams["value"])):?>
                <button>Entra nel gruppo</button>
            <?php endif; ?>
        </section>
<?php endforeach; ?>