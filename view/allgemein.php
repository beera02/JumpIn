<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_flex">
        <a href="user">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/user.png" alt="kopf">
                <p class="p_einstellungsbox">
                    Benutzer
                </p>
            </div>
        </a>
        <a href="group">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/steckbrief.png" alt="gruppe">
                <p class="p_einstellungsbox">
                    Gruppe
                </p>
            </div>
        </a>
    </div>
</div>