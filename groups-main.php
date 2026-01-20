<div>
    <h2> <?php if(isset($templateParams["value"])) echo "RICERCA GRUPPI"; else echo "I TUOI GRUPPI"; ?></h2>
    <?php if($_SESSION['admin'] == false): ?>
        <button id="btn-new-group" onclick="window.location.href='./group-creation.php'">Crea nuovo gruppo</button>
    <?php endif; ?>
</div>
<form action="#" method="post" class="search-bar">
    <label for="ricerca-mio-gruppo">Barra di ricerca<input type="text" id="ricerca-mio-gruppo" name="ricerca-mio-gruppo" placeholder="barra di ricerca"/></label>
    <input type="submit" id="btn-search" name="btn-search" value="Cerca" />
    <input type="submit" id="btn-reset" name="btn-reset" value="Tutti i gruppi" formnovalidate/>
    <?php if(isset($templateParams["value"])):?>
        <label for="course" hidden>Seleziona corso:</label> 
        <select name="course" id="course" required>
            <option value="" disabled selected hidden>seleziona corso</option>
            <?php foreach($templateParams["courses"] as $course): ?>
            <option value="<?php echo $course["nome"] ;?>"><?php echo $course["nome"] ;?></option>
            <?php endforeach; ?>
        </select>
        <div class="filters">
            <ul>
                <?php foreach($templateParams["filters"] as $filter): 
                    $safeId = stringToId($filter["nome"])
                    ?>
                <li><label for="<?php echo $safeId; ?>"><input type="checkbox" id="<?php echo $safeId; ?>" name="<?php echo $safeId; ?>"><?php echo $filter["nome"]; ?></label></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</form>
<?php if(isset($templateParams['value'])): ?>
    <button id="tag-button">Scegli tag</button> 
<?php endif; ?>
    <?php foreach($templateParams["Gruppi"] as $gruppo): ?>
    <section>
        <h3>
            <a href="
            <?php if(isset($templateParams["value"])) echo "./specific-group-to-join.php?idGruppo=".$gruppo['idGruppo']; else echo "./specific-group-to-see.php?idGruppo=".$gruppo['idGruppo']; ?>"
            class="link-header"><?php echo $gruppo['nome']; ?></a>
        </h3>
        <ul class="lista-componenti-gruppo">
            <?php $templateParams["Partecipants"] = $dbh->getPartecipants($gruppo['idGruppo']); ?>
            <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
            <li class="componente"><?php echo $partecipant['nome']." ".$partecipant['cognome']. " - ".$partecipant['email']; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>
            <?php $templateParams["tags"] = $dbh->getGroupTags($gruppo['idGruppo']); 
                $tags = array_column($templateParams["tags"], 'nome');
                echo implode(" - ", $tags);
            ?>
        </p>
        <p>Descrizione: <?php echo $gruppo['descr_breve']; ?> </p>
        <p>Partecipanti: 
            <?php echo $dbh->getNumberOfPartecipants($gruppo['idGruppo'])."/".$dbh->getGroupMaxPartecipants($gruppo['idGruppo']); ?>
        </p>
        <p>Corso: <?php echo $gruppo['corso_di_riferimento']; ?> </p>
    </section>
<?php endforeach; ?>