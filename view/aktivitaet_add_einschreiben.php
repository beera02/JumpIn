<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <form action="validate_aktivitaet_add_einschreiben" method="post">
            <p class="p_form_title">
                Weitere Informationen für das Einschreiben
            </p>
            <p class="p_form">Anzahl Teilnehmer</p>
            <input class="forms_textfield" type="text" name="anzahlteilnehmer"/>
		    <br>
            <p class="p_form">Aufschaltzeit zum einschreiben</p>
            <input class="forms_date" type="date" name="writeindate"/>
            <input class="forms_time" type="time" name="writeintime"/>
            <br>
            <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
        </form>
    </div>
</div>