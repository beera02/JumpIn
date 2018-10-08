<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_flex">
        <a href="aktivitaetsart_add">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/aktivitaetsart_add.png" alt="wanderer/hinzufügenbutton">
                <p class="p_einstellungsbox">
                    Aktivitätsart hinzufügen
                </p>
            </div>
        </a>
        <a href="aktivitaetsart_edit_choice">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/aktivitaetsart_edit.png" alt="wanderer/einstellungsrad">
                <p class="p_einstellungsbox">
                    Aktivitätsart bearbeiten
                </p>
            </div>
        </a>
    </div>
</div>