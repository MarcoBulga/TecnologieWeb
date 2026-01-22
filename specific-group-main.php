<div>
    <form action="#" id="form-generale" method="POST"></form>
    <h2 id="groupname">
        <?php if(isset($templateParams['modify'])): ?>
            <form action="" method="POST" style="display: inline;">
                <label for="new-name" class="visually-hidden">Nuovo Titolo</label><input type="text" name="new-name" id="new-name" form="form-generale" value="<?php echo $dbh->getGroupName($_GET['idGruppo']); ?>" />
            </form>
        <?php else: ?>
            <?php echo $dbh->getGroupName($_GET['idGruppo']); ?>
        <?php endif; ?>
    </h2>
    <?php if(isset($templateParams['modify'])): ?>
        <button type="submit" form="form-generale" name="btn-confirm" id="btn-confirm">Conferma</button>
        <button type="submit" form="form-generale" name="btn-annulla" id="btn-annulla" >Annulla</button>
    <?php elseif($_SESSION['admin'] == false): ?>
        <button onclick=
            '<?php if($templateParams["toSee"] == true) {echo "openPopupToLeave(".$_GET['idGruppo'].")";}
                    else if ($dbh->isGroupPrivate($_GET['idGruppo']) == 0) {echo "openPopupRequestToJoin(document.getElementById(\"groupname\").textContent, ".$_GET['idGruppo'].")";} 
                    else {echo "openPopupRequestToJoinPrivate(document.getElementById(\"groupname\").textContent, ".$_GET['idGruppo'].")";}?>'
            id="btn-new-group"
            <?php if(($templateParams["toSee"] == false && $dbh->getNumberOfPartecipants($_GET['idGruppo']) >= $dbh->getGroupMaxPartecipants($_GET['idGruppo']))
                || (in_array($_SESSION['email'], $dbh->getAllRequests($dbh->getAdministratorOfGroup($_GET['idGruppo']))) && $templateParams['toSee'] == false)): ?>
                    <?php echo "disabled"?> 
            <?php endif; ?> >
            <?php if($templateParams["toSee"] == false && $dbh->getNumberOfPartecipants($_GET['idGruppo']) >= $dbh->getGroupMaxPartecipants($_GET['idGruppo'])) {echo "Gruppo al completo";} 
            else if ($templateParams["toSee"] == false && in_array($_SESSION['email'], $dbh->getAllRequests($dbh->getAdministratorOfGroup($_GET['idGruppo'])))) {echo "In attesa di risposta...";}
            else if ($templateParams["toSee"] == true) { echo "Esci dal gruppo"; } else if($dbh->isGroupPrivate($_GET['idGruppo']) == 1) { echo "Chiedi di unirti"; } else { echo "Unisciti al gruppo"; }?>
        </button>
    <?php endif; ?>
    <?php if($templateParams['toSee'] == true && empty($templateParams['modify']) && $_SESSION['admin'] == false): ?>
        <button type="button" id="chat-btn" name="chat-btn">Chat</button>
    <?php endif; ?>
    <?php if(($dbh->checkAdministrator($_GET["idGruppo"]) && empty($templateParams['modify'])) || ($_SESSION['admin'] == true && empty($templateParams['modify']))): ?>
        <button onclick="window.location.href='./modify-group.php?idGruppo=<?php echo $_GET['idGruppo'] ?>'">Modifica</button>
        <button onclick="openPopupToDeleteGroup('<?php echo $_GET['idGruppo']; ?>','<?php echo $_SESSION['admin']; ?>'); return false;"
        type="submit" id="btn-elimina-gruppo" name="btn-elimina-gruppo" form="form-generale">Elimina gruppo</button>
    <?php endif; ?>
    
</div>
<section class="to-enter">
    <h3>Partecipanti:
        <?php echo $dbh->getNumberOfPartecipants($_GET['idGruppo'])."/".$dbh->getGroupMaxPartecipants($_GET['idGruppo']); ?>
    </h3>
    <ul class="lista-componenti-gruppo">
        <?php $templateParams["Partecipants"] = $dbh->getPartecipants($_GET["idGruppo"]); ?>
        <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
        <li class="componente">
            <?php if(isset($templateParams['modify']) && $partecipant['email'] != $_SESSION['email']): ?>
                <form action="" method="POST" style="display: inline">
                    <button name="btn-user" form="form-generale" value="<?= $partecipant['email'] ?>">X</button>
                </form>
            <?php endif; ?>
            <?php echo $partecipant['nome']." ".$partecipant['cognome'] ?> <?php if($dbh->isUserInGroup($_SESSION['email'], $_GET['idGruppo']) || $_SESSION['admin'] == true) echo " - ".$partecipant['email']; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if(isset($templateParams['modify'])): ?>
        <h3 class="header-descrizione-corta">Descrizione corta:</h3>
        <form action="" method="POST" style="display: inline">
            <label for="new-short-descr" class="visually-hidden">Nuova Descrizione Corta</label><input type="text" form="form-generale" id="new-short-descr" name="new-short-descr" value="<?php echo $dbh->getGroupShortDescription($_GET['idGruppo']); ?>" />
        </form>
    <?php endif; ?>
    <h3 class="header-descrizione-lunga">Descrizione estesa:</h3>
    <?php if(isset($templateParams['modify'])): ?>
        <form action="" method="POST" style="display: inline;">
            <label for="new-long-descr" class="visually-hidden">Nuova Descrizione Lunga</label><input type="text" form="form-generale" id="new-long-descr" name="new-long-descr" value="<?php echo $dbh->getGroupLongDescription($_GET['idGruppo']); ?>" />
        </form>
    <?php else: ?>
        <p class="descrizione-gruppo"><?php echo $dbh->getGroupLongDescription($_GET['idGruppo']) ?></p>
    <?php endif; ?>
</section>

<?php if($templateParams['toSee'] == true) : ?>
    <section id="chat">
        <h3>CHAT</h3>
        <div class="messages-container" id="messages-container">
            <?php foreach($templateParams["chat"] as $message): ?>
                <div class="message">
                    <h4><?php {echo $dbh->getUtente($message["mittente"])['nome']; echo " ".$dbh->getUtente($message["mittente"])['cognome'];} ?></h4>
                    <p><?php echo $message["testo"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="chat-form" action="#" method="POST" >
            <label for="chat-message">Scrivi un messaggio: <input type="text" name="chat-message" id="chat-message" /></label>
            <input type="button" name="send-btn" id="send-btn" value="Invia" />
        </form>
    </section>
<?php endif; ?>

<!--Popup di conferma-->
<div id="popup" class="hidden-popup">
    <div class="popup-elements">
        <p id="popupTextConfirm"></p>
        <?php if($dbh->isGroupPrivate($_GET['idGruppo']) == 1 && $templateParams["toSee"] == false && $_SESSION["admin"] == false): ?>
            <div style="display: flex; justify-content:center; align-items: center; gap: 10px">
                <p>Oggetto:</p>
                <textarea name="oggetto" id="oggetto" placeholder="OGGETTO"></textarea>
            </div>
            <br>
            <div style="display: flex; justify-content:center; align-items: center; gap: 10px">
                <p>Testo:</p>
                <textarea name="richiesta" id="richiesta" placeholder="Ciao, vorrei unirmi al vostro gruppo!"></textarea>
            </div>
        <?php endif; ?>
        <div class="popup-buttons">
            <button id="yes">Si</button>
            <button id="not">No</button>
        </div>
    </div>
</div>