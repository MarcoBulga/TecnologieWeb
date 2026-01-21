<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Ricerca gruppi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/base.css" />
        <?php if($templateParams['title'] == 'login'): ?>
            <link rel="stylesheet" href="./css/login.css" />
        <?php else: ?>
            <link rel="stylesheet" href="./css/register.css" />
        <?php endif; ?>
    </head>
    <body>
        <header>
            <h1><?php echo $templateParams["title"] ?></h1>
        </header>
        <main>
            
        </main>
        <?php foreach($templateParams["js"] as $script): ?>
        <script src="./JavaScript/<?php echo $script ?>"></script>
        <?php endforeach; ?>
        <footer>
        <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
        </footer>
    </body>
</html>