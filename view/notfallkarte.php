<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_flex">
        <a href="notfallkarte_add">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/notfallkarte_add.png" alt="Ambulanz auf Einstellungsrädern">
                <p class="p_einstellungsbox">
                    Notfallkategorie hinzufügen
                </p>
            </div>
        </a>
        <a href="notfallkarte_edit_choice">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/notfallkarte_edit.png" alt="Ambulanz auf Hinzufügenbuttons">
                <p class="p_einstellungsbox">
                    Notfallkategorie bearbeiten
                </p>
            </div>
        </a>
    </div>
</div>