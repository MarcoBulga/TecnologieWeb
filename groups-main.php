<div>
    <h2>I TUOI GRUPPI</h2>
    <a href="./groupCreation.html"><button id="btn-new-group">Crea nuovo gruppo</button></a>
</div>
<input type="text" id="ricerca-mio-gruppo" placeholder="barra di ricerca"/>


<section>
    <?php foreach($templateParams["Gruppi"] as $gruppo): ?>
        <h3>
            <a href="./joinGroup.html" class="link-header"><?php echo $gruppo['nome']; ?></a>
        </h3>
        <ul class="lista-componenti-gruppo">
            <?php $templateParams["Partecipants"] = $dbh->getPartecipants($gruppo['idGruppo']); ?>
            <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
            <li class="componente"><?php echo $partecipant['nome']." ".$partecipant['cognome']; ?></li>
        </ul>
        <p>Descrizione: <?php echo $gruppo['descr_breve']; ?> </p>
        <p>Categoria: <?php echo $gruppo['corso_di_riferimento']; ?> </p>
        <button>Entra nel gruppo</button>
    <?php endforeach; ?>
</section>