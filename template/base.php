<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="./JavaScript/script.js" defer></script>
    <title>Ricerca Gruppi</title>
</head>
<body>
    <a href="./register.html">registrazione</a>
    <a href="./login.html">login</a>
    <a href="./index.html">PAGINA PRESENTAZIONE</a>
    <a href="./search.html"> test ricerca</a>
    <a href="./groupCreation.html"> test creazione gruppi</a>
    <header>
        <h1>Ricerca Gruppi</h1>
    </header>
    <nav>
        <ul>
            <li><p>nome utente</p></li>
            <li><button id="bottone-notifiche">notifica</button></li>
            <li><button id="bottone-menu">menu</button></li>
        </ul>
    </nav>
    <nav id="menu">
        <ul>
            <li><button onclick="window.location.href='./search.html'">Ricerca nuovo gruppo</button></li>
            <li><button onclick="window.location.href='./user-groups.php'">I tuoi gruppi</button></li>
            <li><button onclick="window.location.href='./groupCreation.html'">Crea nuovo gruppo</button></li>
            <li><button>Segnala un problema</button></li>
            <li><button>Logout</button></li>
        </ul>
        <button id="chiudi-menu">Chiudi</button>
    </nav>
    <nav id="notifiche">
        <div class="notification" onclick="openMessage(this)">
            <div class="messaggio">
                <p id="object">Questa è una notifica</p>
                <p id="sender">Mittente</p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <div class="notification" onclick="openRequest(this)">
            <div class="messaggio">
                <p id="object">Questa è una richiesta</p>
                <p id="sender">Mittente</p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <button id="chiudi-notifiche">Chiudi</button>
    </nav>
    <main>
        <?php require $templateParams["page"]; ?>
    </main>
    <footer>
        <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
    </footer>
</body>
</html>