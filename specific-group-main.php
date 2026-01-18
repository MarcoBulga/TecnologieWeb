<div>
    <h2 id="groupname">NOME GRUPPO</h2>
    <button onclick=
        <?php if($templateParams["toSee"] == true) {echo "openPopupToLeave()";}
                else {echo "openPopupRequestToJoin(document.getElementById('groupname').textContent)";} ?>
         id="btn-new-group">
        <?php if($templateParams["toSee"] == true) { echo "Esci dal gruppo"; } else { echo "Unisciti / chiedi di unirti"; } ?>
    </button>
</div>
<section class="to-enter">
    <ul class="lista-componenti-gruppo">
        <li class="componente">Componente 1</li>
        <li class="componente">Componente 2</li>
        <li class="componente">Componente 3</li>
        <li class="componente">Componente 4</li>
        <li class="componente">Componente 5</li>
    </ul>
    <h3 class="header-descrizione">Descrizione estesa:</h3>
    <p class="descrizione-gruppo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit quisquam doloremque quam asperiores fugit vel quaerat laborum hic quo nostrum architecto error nam provident quis, quos eligendi pariatur unde, iusto adipisci? Eum praesentium sapiente soluta laudantium dolorum molestias modi debitis maiores minus accusantium, asperiores officiis assumenda iure amet accusamus aperiam esse reiciendis optio deserunt magni quas voluptas ut eius quisquam! Dolorem nostrum placeat dolorum suscipit eligendi vel incidunt. Quo sint praesentium laborum nobis at deserunt repellat, recusandae ullam odio maiores consectetur illum iste officiis quos nisi esse ab totam. Eaque fugit ipsa doloremque. Tempore, natus repellat blanditiis ex temporibus beatae.</p>
</section>

<!--Popup di conferma-->
<div id="popup" class="hidden-popup">
    <div class="popup-elements">
        <p id="popupText"></p>
        <div class="popup-buttons">
            <button id="not">No</button>
            <button id="yes">Si</button>
        </div>
    </div>
</div>