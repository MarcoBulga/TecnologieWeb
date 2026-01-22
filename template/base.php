<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./css/base.css" />
    <?php foreach($templateParams["css"] as $sheet): ?>
    <link rel="stylesheet" href="./css/<?php echo $sheet; ?>.css"/>
    <?php endforeach; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="./JavaScript/script.js" defer></script>
    <script src="./JavaScript/groupManager.js" defer></script>
    <?php if(isset($templateParams["js"])): ?>
    <script src="./JavaScript/<?php echo $templateParams["js"]; ?>" defer></script>
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <title>Gruppiamo</title>
</head>
<body>
    <header>
        <button type="button" id="return-button" name="return button" onclick="history.back()">indietro</button>
        <h1>Gruppiamo</h1>
    </header>
    <section id="sub-header">
        <ul class="normalButtons">
            <li><p><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?></p></li>
            <li><button id="bottone-notifiche">notifiche</button></li>
            <li><button id="bottone-menu">menu</button></li>
        </ul>
    </section>
    <nav id="menu">
        <ul>
            <?php if($_SESSION['admin'] == false): ?>
                <li><button onclick="window.location.href='./search.php'">Cerca gruppi</button></li>
                <li><button onclick="window.location.href='./user-groups.php'">I tuoi gruppi</button></li>
                <li><button onclick="window.location.href='./group-creation.php'">Crea nuovo gruppo</button></li>
            <?php endif; ?>
            <?php if($_SESSION['admin'] == false): ?>
                <li><button
                        onclick="openPopupReport()">Segnala un problema</button></li>
            <?php else: ?>
                <li><button onclick="window.location.href='./search.php'">Tutti i gruppi</button></li>
                <li><button onclick="window.location.href='./reports.php'">Segnalazioni</button></li>
                <li><button onclick="window.location.href='./course-change.php'">Corsi / Tag</button></li>
            <?php endif; ?>
            <li><button onclick="window.location.href='./logout.php'">Logout</button></li>
        </ul>
        <button id="chiudi-menu">Chiudi</button>
    </nav>
    <section id="notifiche">
        <?php foreach($templateParams["notifications"] as $notification): ?>
        <div class="notification"
            data-mittente = "<?php echo $notification['mittente']; ?>"
            data-idnotifica="<?php echo $notification['idNotifica']; ?>" 
            data-idgruppo="<?php echo $notification['idGruppo']; ?>"
            data-nomegruppo="<?php echo $notification['nomeGruppo']; ?>"
            onclick="openMessage(this,
            '<?php echo $notification['tipo']; ?>', 
            '<?php echo htmlspecialchars($notification['testo']); ?>',
            '<?php echo htmlspecialchars($notification['nomeGruppo'] ?? '') ; ?>')">
            <div class="messaggio">
                <p><?php echo $notification["oggetto"]; ?></p>
                <p><?php echo $dbh->getUtente($notification["mittente"])['nome']; echo " "; echo $dbh->getUtente($notification["mittente"])['cognome'];?></p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <?php endforeach; ?>
        <button id="chiudi-notifiche">Chiudi</button>
    </section>
    <main>
        <?php require $templateParams["page"]; ?>
    </main>

    <!--POPUP NOTIFICA NORMALE-->
        <div id="notificationPopup" class="hidden-popup">
            <div class="popup-elements">
                <h2 id="popupObject">placeholder</h2>
                <p id="popupText"></p>
                <p><strong> riguardo al gruppo:</strong> <span id="popupGroupNameMessage"></span></p>
                <p id="popupSender"></p>
                <div class="popup-buttons">
                    <button id="no">Chiudi</button>
                </div>
            </div>
        </div>

        <!--POPUP NOTIFICA RICHIESTA-->
        <div id="notificationPopupRequest" class="hidden-popup">
            <div class="popup-elements">
                <h2 id="popupObjectRequest">placeholder</h2>
                <p id="popupTextRequest"></p>
                <p><strong> riguardo al gruppo:</strong> <span id="popupGroupNameRequest"></span></p>
                <p id="popupSenderRequest"></p>
                <div class="popup-buttons">
                    <button id="yesRequest">Accetta</button>
                    <button id="noRequest">Rifiuta</button>
                </div>
            </div>
        </div>

        <!--Popup di conferma-->
        <div id="popupReportSend" class="hidden-popup">
            <div class="popup-elements">
                <p id="popupHeaderReportSend"></p>
                <div style="display: flex; justify-content:center; align-items: center; gap: 10px">
                    <p>Oggetto:</p>
                    <label for="popupObjectReportSend" class="visually-hidden"> oggetto della segnalazione</label><textarea name="popupObjectReportSend" id="popupObjectReportSend" placeholder="OGGETTO"></textarea> 
                </div>
                <br>
                <div style="display: flex; justify-content:center; align-items: center; gap: 10px">
                    <p>Testo:</p>
                    <label for="popupTextReportSend" class="visually-hidden">testo della segnalazione</label><textarea name="popupTextReportSend" id="popupTextReportSend" placeholder="Questo sito fa schifo!"></textarea>
                </div>
                <div class="popup-buttons">
                    <button id="conferma">Conferma</button>
                    <button id="annulla">Annulla</button>
                </div>
            </div>
        </div>

        <!--Popup di conferma-->
        <div id="popupConfirm" class="hidden-popup">
            <div class="popup-elements">
                <p id="popupTextSuccess"></p>
                <div class="popup-buttons">
                    <button id="chiudiConfirm">Chiudi</button>
                </div>
            </div>
        </div>
    <footer>
        <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
    </footer>
</body>
</html>