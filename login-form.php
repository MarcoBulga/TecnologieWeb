<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Ricerca gruppi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css" />
    </head>
    <body>
        <a href="./index.html">pagina presentazione</a>
        <a href="./user-groups.php">i tuoi gruppi</a>
        <a href="./register.html">registrati</a>
        <header>
            <h1><?php echo $templateParams["title"] ?></h1>
        </header>
        <main>
            
        </main>
        <?php foreach($templateParams["js"] as $script): ?>
        <script src="./JavaScript/<?php echo $script ?>"></script>
        <?php endforeach; ?>
    </body>
</html>