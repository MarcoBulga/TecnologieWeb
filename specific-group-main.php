<div>
    <form action="" id="form-generale" method="POST"></form>
    <h2 id="groupname">
        <?php if(isset($templateParams['modify'])): ?>
            <form action="" method="POST" style="display: inline;">
                <input type="text" name="new-name" form="form-generale" value="<?php echo $dbh->getGroupName($_GET['idGruppo']); ?>" />
            </form>
        <?php else: ?>
            <?php echo $dbh->getGroupName($_GET['idGruppo']); ?>
        <?php endif; ?>  
    </h2>
    <?php if(isset($templateParams['modify'])): ?>
        <button type="submit" form="form-generale" name="btn-confirm">Conferma</button>
        <button type="submit" form="form-generale" name="btn-annulla">Annulla</button>
    <?php elseif($_SESSION['admin'] == false): ?>
        <button onclick=
            <?php if($templateParams["toSee"] == true) {echo "openPopupToLeave(".$_GET['idGruppo'].")";}
                    else {echo "openPopupRequestToJoin(document.getElementById('groupname').textContent)";} ?>
            id="btn-new-group">
            <?php if($templateParams["toSee"] == true) { echo "Esci dal gruppo"; } else if($dbh->isGroupPrivate($_GET['idGruppo']) == 1) { echo "Chiedi di unirti"; } else { echo "Unisciti al gruppo"; }?>
        </button>
    <?php endif; ?>
    <?php if(($dbh->checkAdministrator($_GET["idGruppo"]) && empty($templateParams['modify'])) || ($_SESSION['admin'] == true && empty($templateParams['modify']))): ?>
        <button onclick="window.location.href='./modify-group.php?idGruppo=<?php echo $_GET['idGruppo'] ?>'">Modifica</button>
        <button type="submit" id="btn-elimina-gruppo" name="btn-elimina-gruppo" form="form-generale">Elimina gruppo</button>
    <?php endif; ?>
</div>
<section class="to-enter">
    <h3>Partecipanti:</h3>
    <ul class="lista-componenti-gruppo">
        <?php $templateParams["Partecipants"] = $dbh->getPartecipants($_GET["idGruppo"]); ?>
        <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
        <li class="componente">
            <?php if(isset($templateParams['modify']) && $partecipant['email'] != $_SESSION['email']): ?>
                <form action="" method="POST" style="display: inline">
                    <button name="btn-user" form="form-generale" value="<?= $partecipant['email'] ?>">X</button>
                </form>
            <?php endif; ?>
            <?php echo $partecipant['nome']." ".$partecipant['cognome']. " - ".$partecipant['email']; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if(isset($templateParams['modify'])): ?>
        <h3 class="header-descrizione-corta">Descrizione corta:</h3>
        <form action="" method="POST" style="display: inline">
            <input type="text" form="form-generale" name="new-short-descr" value="<?php echo $dbh->getGroupShortDescription($_GET['idGruppo']); ?>" />
        </form>
    <?php endif; ?>
    <h3 class="header-descrizione-lunga">Descrizione estesa:</h3>
    <?php if(isset($templateParams['modify'])): ?>
        <form action="" method="POST" style="display: inline;">
            <input type="text" form="form-generale" name="new-long-descr" value="<?php echo $dbh->getGroupLongDescription($_GET['idGruppo']); ?>" />
        </form>
    <?php else: ?>
        <p class="descrizione-gruppo"><?php echo $dbh->getGroupLongDescription($_GET['idGruppo']) ?></p>
    <?php endif; ?>
</section>

<!--Popup di conferma-->
<div id="popup" class="hidden-popup">
    <div class="popup-elements">
        <p id="popupText"></p>
        <div class="popup-buttons">
            <button id="not">No</button>
            <button id="yes">Si</button>
        </div>
    </div>
</div>