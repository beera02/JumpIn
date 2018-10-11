<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_flex">
        <a href="feedback_add">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/feedback_add.png" alt="Sprechblase mit Hinzufügen Button">
                <p class="p_einstellungsbox">
                    Feedbackkat. hinzufügen
                </p>
            </div>
        </a>
        <a href="feedback_edit_choice">
            <div class="einstellungsbox">
                <img class="img_einstellungsbox" src="./image/feedback_edit.png" alt="Sprechblase mit Einstellungsrad">
                <p class="p_einstellungsbox">
                    Feedbackkat. bearbeiten
                </p>
            </div>
        </a>
    </div>
</div>