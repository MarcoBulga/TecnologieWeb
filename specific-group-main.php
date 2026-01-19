<div>
    <h2 id="groupname">
        <?php if(isset($templateParams['modify'])): ?>
            <form action="processa-modifica.php" method="POST" style="display: inline;">
                <input type="text" name="new_name" value="<?php echo $dbh->getGroupName($_GET['idGruppo']); ?>" />
            </form>
        <?php else: ?>
            <?php echo $dbh->getGroupName($_GET['idGruppo']); ?>
        <?php endif; ?>  
    </h2>
    <?php if(isset($templateParams['modify'])): ?>
        <button type="submit" name="btn-confirm">Conferma</button>
        <button name="btn-annulla" onclick= "window.location.href='./specific-group-to-see.php?idGruppo=<?php echo $_GET['idGruppo'] ?>'">Annulla</button>
    <?php else: ?>
        <button onclick=
            <?php if($templateParams["toSee"] == true) {echo "openPopupToLeave(".$_GET['idGruppo'].")";}
                    else {echo "openPopupRequestToJoin(document.getElementById('groupname').textContent)";} ?>
            id="btn-new-group">
            <?php if($templateParams["toSee"] == true) { echo "Esci dal gruppo"; } else if($dbh->isGroupPrivate($_GET['idGruppo']) == 1) { echo "Chiedi di unirti"; } else { echo "Unisciti al gruppo"; }?>
        </button>
    <?php endif; ?>
    <?php if($dbh->checkAdministrator($_GET["idGruppo"]) && empty($templateParams['modify'])): ?>
        <button onclick="window.location.href='./modify-group.php?idGruppo=<?php echo $_GET['idGruppo'] ?>'">Modifica</button>
    <?php endif; ?>
</div>
<section class="to-enter">
    <h3>Partecipanti:</h3>
    <ul class="lista-componenti-gruppo">
        <?php $templateParams["Partecipants"] = $dbh->getPartecipants($_GET["idGruppo"]); ?>
        <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
        <li class="componente">
            <?php if(isset($templateParams['modify'])): ?>
                <button name="btn-user">X</button>
            <?php endif; ?>
            <?php echo $partecipant['nome']." ".$partecipant['cognome']. " - ".$partecipant['email']; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php ?>
    <h3 class="header-descrizione">Descrizione estesa:</h3>
    <p class="descrizione-gruppo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit quisquam doloremque quam asperiores fugit vel quaerat laborum hic quo nostrum architecto error nam provident quis, quos eligendi pariatur unde, iusto adipisci? Eum praesentium sapiente soluta laudantium dolorum molestias modi debitis maiores minus accusantium, asperiores officiis assumenda iure amet accusamus aperiam esse reiciendis optio deserunt magni quas voluptas ut eius quisquam! Dolorem nostrum placeat dolorum suscipit eligendi vel incidunt. Quo sint praesentium laborum nobis at deserunt repellat, recusandae ullam odio maiores consectetur illum iste officiis quos nisi esse ab totam. Eaque fugit ipsa doloremque. Tempore, natus repellat blanditiis ex temporibus beatae.</p>
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