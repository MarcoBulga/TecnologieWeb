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
            <li><button>Ricerca nuovo gruppo</button></li>
            <li><button>I tuoi gruppi</button></li>
            <li><button>Crea nuovo gruppo</button></li>
            <li><button>Segnala un problema</button></li>
            <li><button>Logout</button></li>
        </ul>
        <button id="chiudi-menu">Chiudi</button>
    </nav>
    <nav id="notifiche">
        <div class="notification">
            <div class="messaggio">
                <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                <p>Mittente</p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <div class="notification">
            <div class="messaggio">
                <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                <p>Mittente</p>
            </div>
            <button class="elimina-notifica">X</button>
        </div>
        <button id="chiudi-notifiche">Chiudi</button>
    </nav>
    <main>
        <h2>I TUOI GRUPPI</h2>
        <?php foreach($templateParams["Gruppi"] as $gruppo): ?>
            <div class="gruppo">
                <h3><?php echo $gruppo['nome']; ?></h3>
                <p>Descrizione: <?php echo $gruppo['descr_breve']; ?> </p>
                <p>Categoria: <?php echo $gruppo['corso_di_riferimento']; ?> </p>
                <button>Entra nel gruppo</button>
            </div>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
    </footer>
</body>
</html>