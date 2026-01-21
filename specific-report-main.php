<div>
    <form action="" id="form-generale" method="POST"></form>
    <h2 id="reportId">
        Segnalazione n.<?php echo $_GET['idNotifica']; ?>  
    </h2>
    <button class="btn-delete-report" id="btn-delete-report" name="btn-delete-report"
            data-idnotifica = "<?php echo $_GET['idNotifica']; ?>"
            onclick="openPopupToDeleteReport(this)">
        Elimina Segnalazione
    </button>
</div>
<section class="to-enter">
    <h3 id="reportObject" name="reportObject"> <?php echo $dbh->getNotificationObject($_GET['idNotifica']); ?> </h3>
    <p id="reportText" name="reportText"> <?php echo $dbh->getNotificationText($_GET['idNotifica'])?> </p>
</section>

<!--Popup di conferma-->
<div id="popup" class="hidden-popup">
    <div class="popup-elements">
        <p id="popupTextReport"></p>
        <div class="popup-buttons">
            <button id="yesReport">Si</button>
            <button id="noReport">No</button>
        </div>
    </div>
</div>