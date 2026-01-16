<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ricerca Gruppi</title>
</head>
<body>
    <a href="./register.html">registrazione</a>
    <ul>
    <?php foreach($templateParams["Utenti"] as $utente): ?>
        <li><?php echo $utente["nome"]." ".$utente["cognome"]; ?></li>
    <?php endforeach; ?>
    </ul>
    <header>
        <h1>Ricerca Gruppi</h1>
    </header>
    <nav>
        <ul>
            <p>nome utente</p>
            <button>notifica</button>
            <button>menu</button>
        </ul>
    </nav>
    <nav>
        <ul>
            <button>Ricerca nuovo gruppo</button>
            <button>I tuoi gruppi</button>
            <button>Crea nuovo gruppo</button>
            <button>Segnala un problema</button>
            <button>Logout</button>
        </ul>
    </nav>
    <nav>
        <ul>
            <div class="notification">
                <p>Oggetto</p>
                <p>Mittente</p>
                <button>X</button>
            </div>
        </ul>
    </nav>
    <main>
        <h2>I TUOI GRUPPI</h2>
    </main>
    <footer>
        <p>footer</p>
    </footer>
</body>
</html>