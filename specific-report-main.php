<div>
    <form action="" id="form-generale" method="POST"></form>
    <h2 id="reportId">
        Segnalazione n.<?php echo $_GET['idNotifica']; ?>  
    </h2>
    <button onclick=
        '<?php echo "openPopupToDeleteReport(".$_GET['idNotifica'].")"; ?>'
        id="btn-delete-report" >
        Elimina Segnalazione
    </button>
</div>
<section class="to-enter">
    <h3 id="reportObject" name="reportObject"> <?php echo $dbh->getNotificationObject($_GET['idNotifica']); ?> </h3>
    <p id="reportText" name="reportText"> <?php echo $dbh->getNotificationText($_GET['idNotifica'])?> </p>
</section>