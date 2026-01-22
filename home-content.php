<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/index.css" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <title><?php  {echo "home-page";} ?></title>
    </head>
    <body>
        <article class="landing-page">
            <header class="hero">
                <h1>Trova il gruppo giusto per i tuoi progetti universitari</h1>
                <p class="hero-subtitle">La piattaforma che semplifica la collaborazione accademica. Cerca, crea e gestisci i tuoi gruppi di lavoro in un unico posto.</p>
                <div class="cta-header">
                    <a href="login.php" class="btn-primary">Inizia Ora</a>
                </div>
            </header>

            <section class="feature-row">
                <div class="content-wrapper">
                    <div class="text-block">
                        <span class="badge">Esplora</span>
                        <h2>Trova gruppi adatti a te</h2>
                        <p>Usa tag intelligenti e parole chiave per filtrare i progetti. Connettiti con studenti che condividono i tuoi stessi interessi e competenze.</p>
                    </div>
                    <div class="visual-block">
                        <picture class="phone-mockup">
                            <source media="(max-width: 768px)" srcset="./upload/cerca-gruppo-PHONE.png" />
                            <img src="./upload/cerca-gruppo-PC.png" alt="Ricerca Gruppi" />
                        </picture>
                    </div>
                </div>
            </section>

            <section class="feature-row reverse">
                <div class="content-wrapper">
                    <div class="text-block">
                        <span class="badge">Organizza</span>
                        <h2>Crea e gestisci i tuoi gruppi</h2>
                        <p>Prendi il controllo dei tuoi progetti. Gestisci i membri e accedi rapidamente ai contatti per un coordinamento perfetto e ordinato.</p>
                    </div>
                    <div class="visual-block">
                        <div class="images-slider">
                            <picture class="phone-mockup">
                                <img src="./upload/crea-gruppo-PC.png" alt="Creazione gruppo" />
                            </picture>
                            <picture class="phone-mockup">
                                <img src="./upload/modifica-gruppo-PC.png" alt="Modifica gruppo" />
                            </picture>
                        </div>
                        <p class="slider-hint">Scorri per vedere la gestione &rarr;</p>
                    </div>
                </div>
            </section>

            <section class="feature-row">
                <div class="content-wrapper">
                    <div class="text-block">
                        <span class="badge">Comunica</span>
                        <h2>Chat di gruppo integrata</h2>
                        <p>Dimentica le app esterne. Ogni gruppo ha uno spazio dedicato per confrontarsi in tempo reale e prendere decisioni veloci.</p>
                    </div>
                    <div class="visual-block">
                        <picture class="phone-mockup">
                            <source media="(max-width: 768px)" srcset="./upload/chat-PHONE.png" />
                            <img src="./upload/chat-PC.png" alt="Chat Integrata" />
                        </picture>
                    </div>
                </div>
            </section>

            <footer class="final-cta">
                <h2>Pronto a migliorare il tuo modo di studiare?</h2>
                <p>Accedi o registrati per iniziare subito.</p>
                <div class="button-group">
                    <a href="login.php" class="btn-main">Accedi</a>
                    <a href="register.php" class="btn-outline">Registrati</a>
                </div>
            </footer>
        </article>
        <div id="lightbox-overlay" class="hidden-popup" style="display: none; cursor: pointer;">
            <span style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; font-weight: bold;">&times;</span>
            <img id="lightbox-img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="Ingrandimento" style="max-width: 90%; max-height: 90%; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.5);">
        </div>

        <!-- script per far ingrandire le immagini -->
        <script>
            const overlay = document.getElementById('lightbox-overlay');
            const lightboxImg = document.getElementById('lightbox-img');

            // Seleziona tutte le immagini dentro i mockup
            document.querySelectorAll('.phone-mockup img').forEach(img => {
                img.style.cursor = 'zoom-in';
                img.addEventListener('click', () => {
                    lightboxImg.src = img.src;
                    overlay.style.display = 'flex';
                    overlay.classList.add('show');
                });
            });

            // Chiudi immagine quando clicchi sull'overlay
            overlay.addEventListener('click', () => {
                overlay.style.display = 'none';
                lightboxImg.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
            });
        </script>
    </body>
</html>