<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="./JavaScript/script.js" defer></script>
    <script src="./JavaScript/groupManager.js" defer></script>
    <title>Ricerca Gruppi</title>
</head>
<body>
    <header>
        <h1>Ricerca Gruppi</h1>
    </header>
    <nav>
        <ul>
            <li><p><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?></p></li>
            <li><button id="bottone-notifiche">notifica</button></li>
            <li><button id="bottone-menu">menu</button></li>
        </ul>
    </nav>
    <nav id="menu">
        <ul>
            <?php if($_SESSION['admin'] == false): ?>
                <li><button onclick="window.location.href='./search.php'">Cerca gruppi</button></li>
                <li><button onclick="window.location.href='./user-groups.php'">I tuoi gruppi</button></li>
                <li><button onclick="window.location.href='./group-creation.php'">Crea nuovo gruppo</button></li>
            <?php endif; ?>
            <?php if($_SESSION['admin'] == false): ?>
                <li><button>Segnala un problema</button></li>
            <?php else: ?>
                <li><button onclick="window.location.href='./search.php'">Tutti i gruppi</button></li>
                <li><button>Segnalazioni</button></li>
            <?php endif; ?>
            <li><button onclick="window.location.href='./logout.php'">Logout</button></li>
        </ul>
        <button id="chiudi-menu">Chiudi</button>
    </nav>
    <nav id="notifiche">
        <?php foreach($templateParams["notifications"] as $notification): ?>
        <div class="notification" onclick="openMessage(this, '<?php echo $notification['tipo']; ?>', '<?php echo addslashes($notification['testo']); ?>')">
            <div class="messaggio">
                <p><?php echo $notification["oggetto"]; ?></p>
                <p><?php echo $notification["mittente"]; ?></p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <?php endforeach; ?>
        <button class="elimina-notifica">X</button>
        <button id="chiudi-notifiche">Chiudi</button>
    </nav>
    <main>
        <?php require $templateParams["page"]; ?>
    </main>

    <!--POPUP NOTIFICA NORMALE-->
        <div id="notificationPopup" class="hidden-popup">
            <div class="popup-elements">
                <h2 id="popupObject">placeholder</h2>
                <p id="popupText"></p>
                <p id="popupSender"></p>
                <div class="popup-buttons">
                    <button id="no">Cancella</button>
                </div>
            </div>
        </div>

        <!--POPUP NOTIFICA RICHIESTA-->
        <div id="notificationPopupRequest" class="hidden-popup">
            <div class="popup-elements">
                <h2 id="popupObjectRequest">placeholder</h2>
                <p id="popupTextRequest"></p>
                <p id="popupSenderRequest"></p>
                <div class="popup-buttons">
                    <button id="noRequest">Rifiuta</button>
                    <button id="yesRequest">Accetta</button>
                </div>
            </div>
        </div>
    <footer>
        <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
    </footer>
</body>
</html>