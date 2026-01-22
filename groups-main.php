<div>
    <h2> <?php if(isset($templateParams['report'])) echo "SEGNALAZIONI"; elseif(isset($templateParams["value"])) echo "RICERCA GRUPPI"; else echo "I TUOI GRUPPI"; ?></h2>
    <?php if($_SESSION['admin'] == false && empty($templateParams['value'])): ?>
        <button id="btn-new-group" onclick="window.location.href='./group-creation.php'">+</button>
    <?php endif; ?>
</div>
<form action="#" method="post" class="search-bar">
    <div class="search-main-row">
        <label for="ricerca-mio-gruppo" class="visually-hidden">Barra di ricerca</label><input type="text" id="ricerca-mio-gruppo" name="ricerca-mio-gruppo" placeholder="barra di ricerca"/>
        <input type="submit" id="btn-search" name="btn-search" value="Cerca" />
    </div>

    <div class="search-controls-row">
        <input type="submit" id="btn-reset" name="btn-reset" value="<?php if(isset($templateParams['report'])) {echo 'Tutte le segnalazioni';} else {echo 'Tutti i gruppi';} ?>" formnovalidate />
        <?php if(isset($templateParams["value"]) && empty($templateParams['report'])):?>
            <label for="course" hidden>Seleziona corso:</label>
            <select name="course" id="course" required>
                <option value="" disabled selected hidden>seleziona corso</option>
                    <?php foreach($templateParams["courses"] as $course): ?>
                        <option value="<?php echo $course["nome"] ;?>"><?php echo $course["nome"] ;?></option>
                    <?php endforeach; ?>
            </select>
            <button type="button" id="tag-button" name="tag-button">Scegli tag</button> 
        <?php endif; ?>
    </div>
    <?php if(isset($templateParams["value"]) && empty($templateParams['report'])):?>
        <div class="filters">
            <ul>
                <?php foreach($templateParams["filters"] as $filter): 
                    $safeId = stringToId($filter["nome"])
                    ?>
                <li><label for="<?php echo $safeId; ?>"><input type="checkbox" id="<?php echo $safeId; ?>" name="<?php echo $safeId; ?>"><?php echo $filter["nome"]; ?></label></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</form>

<?php if(empty($templateParams['report'])): ?>
    <?php if(empty($templateParams['Gruppi'])): ?>
        <p id="no-result">Nessun risultato...</p>
    <?php else: ?>
        <?php foreach($templateParams["Gruppi"] as $gruppo): ?>
        <section>
            <h3>
                <a href="
                <?php if(isset($templateParams["value"])) echo "./specific-group-to-join.php?idGruppo=".$gruppo['idGruppo']; else echo "./specific-group-to-see.php?idGruppo=".$gruppo['idGruppo']; ?>"
                class="link-header"><?php echo $gruppo['nome']; ?></a>
            </h3>
            <ul class="lista-componenti-gruppo">
                <?php $templateParams["Partecipants"] = $dbh->getPartecipants($gruppo['idGruppo']); ?>
                <?php foreach($templateParams["Partecipants"] as $partecipant): ?>
                <li class="componente"><?php echo $partecipant['nome']." ".$partecipant['cognome']?> <?php if($dbh->isUserInGroup($_SESSION['email'], $gruppo['idGruppo']) || $_SESSION['admin'] == true) echo " - ".$partecipant['email']; ?> </li>
                <?php endforeach; ?>
            </ul>
            <p>
                <strong><?php $templateParams["tags"] = $dbh->getGroupTags($gruppo['idGruppo']); 
                    $tags = array_column($templateParams["tags"], 'nome');
                    echo implode(" - ", $tags);
                ?>
                </strong>
            </p>
            <p><strong>Descrizione:</strong> <?php echo $gruppo['descr_breve']; ?> </p>
            <p><strong>Partecipanti:</strong> 
                <?php echo $dbh->getNumberOfPartecipants($gruppo['idGruppo'])."/".$dbh->getGroupMaxPartecipants($gruppo['idGruppo']); ?>
            </p>
            <p><strong>Corso:</strong> <?php echo $gruppo['corso_di_riferimento']; ?> </p>
        </section>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(empty($templateParams['Segnalazioni'])): ?>
        <p id="no-report">Nessuna segnalazione...</p>
    <?php else: ?>
        <?php foreach($templateParams["Segnalazioni"] as $segnalazione): ?>
        <section>
            <h3>
                <a href="<?php echo './specific-report.php?idNotifica='.$segnalazione['idNotifica']; ?>" class="link-header"><?php echo $segnalazione['oggetto']; ?></a>
            </h3>
            <p class="text-report"><?php echo $segnalazione['testo']; ?></p>
            <p><strong>Mittente: </strong><?php echo $dbh->getUtente($segnalazione["mittente"])['nome']; echo " "; echo $dbh->getUtente($segnalazione["mittente"])['cognome']; ?> </p>
        </section>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>

<div class="parent">
    <div class="impagination">
        <div class="left">
            <?php if($pageNumber > 0): ?> 
                <button type="button" name="back-button" id="back-button" onclick="window.location.href='?pageNumber=<?php echo $pageNumber-1; ?>&ricerca=<?php echo $ricerca; ?>&researchString=<?php echo $researchString; ?>&number=<?php echo $number; ?><?php if(isset($selectedFilters)): ?>&<?php echo http_build_query(array('selectedFilters' => $selectedFilters)); endif; ?><?php if(isset($corso)): ?>&corso=<?php echo $corso; endif;?>'"><</button>
            <?php endif; ?>
        </div>
        
        <p class="center"><?php echo $pageNumber + 1; ?></p>

        <div class="right">
            <?php if( $forward ): ?> 
            <button type="button" name="forward-button" id="forward-button" onclick="window.location.href='?pageNumber=<?php echo $pageNumber+1; ?>&ricerca=<?php echo $ricerca; ?>&researchString=<?php echo $researchString; ?>&number=<?php echo $number; ?><?php if(isset($selectedFilters)): ?>&<?php echo http_build_query(array('selectedFilters' => $selectedFilters)); endif; ?><?php if(isset($corso)):   ?>&corso=<?php echo $corso; endif;?>'">></button>
            <?php endif; ?>        
        </div>
        
    </div>
</div>
