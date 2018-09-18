<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_flex">
        <a href="user_add">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/user_add.png" alt="einstellungsrad">
                <p class="p_einstellungsbox">
                    Benutzer hinzufügen
                </p>
            </div>
        </a>
        <a href="user_edit">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/user_edit.png" alt="einstellungsrad">
                <p class="p_einstellungsbox">
                    Benutzer bearbeiten
                </p>
            </div>
        </a>
    </div>
</div>