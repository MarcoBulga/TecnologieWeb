<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/base.css" />
        <link rel="stylesheet" href="./css/index.css" />
        <title><?php echo $templateParams["title"] ?></title>
    </head>
    <body>
        <header>
            <h1><?php echo $templateParams["title"] ?></h1>
        </header>
        <nav>
            <ul class="registerLoginBtns">
                <li><p><?php echo $templateParams["user"] ?></p></li>
                <li><a href="./login.php" class="btn">login</a></li>
                <li><a href="./register.php" class="btn">registrati</a></li>
            </ul>           
        </nav>
        <main>
            <?php require($templateParams["content"]) ?>
        </main>
        <footer>
            <p>Daniele Tramonti (daniele.tramonti2@studio.unibo.it) - Alessandro Ravaioli (alessandro.ravaioli8@studio.unibo.it) - Marco Bulgarelli (marco.bulgarelli6@studio.unibo.it)</p>
        </footer>
    </body>
</html>