<div>
    <h2> <?php if(isset($templateParams["value"])) echo "RICERCA GRUPPI"; else echo "I TUOI GRUPPI"; ?></h2>
    <a href="./group-creation.php"><button id="btn-new-group">Crea nuovo gruppo</button></a>
</div>
<form action="#" method="post" class="search-bar">
    <input type="text" id="ricerca-mio-gruppo" name="ricerca-mio-gruppo" placeholder="barra di ricerca"/>
    <input type="submit" id="btn-search" name="btn-search" value="Cerca" />
    <input type="submit" id="btn-reset" name="btn-reset" value="Tutti i gruppi" />
</form>
<?php if(isset($templateParams["value"]) && isset($_POST["ricerca-mio-gruppo"])) {
        $templateParams["Gruppi"] = $dbh->searchName($_POST["ricerca-mio-gruppo"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } else if(isset($templateParams["value"]) && isset($_POST["btn-reset"])) {
        $templateParams["Gruppi"] = $dbh->groupsWithNoUserInSession();
        unset($_POST["btn-reset"]);
    } else if(isset($_POST["ricerca-mio-gruppo"])) {
        $templateParams["Gruppi"] = $dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } else if(isset($_POST["btn-reset"])) {
        $templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);
        unset($_POST["btn-reset"]);
    }?>
<?php foreach($templateParams["Gruppi"] as $gruppo): ?>
    <section>
        <h3>
            <a href=
            <?php if(isset($templateParams["value"])) echo "./specific-group-to-join.php?idGruppo=".$gruppo['idGruppo']; else echo "./specific-group-to-see.php?idGruppo=".$gruppo['idGruppo']; ?>
            class="link-header"><?php echo $gruppo['nome']; ?></a>
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