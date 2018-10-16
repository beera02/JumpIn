<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <form action="validate_group_add" method="post">
            <p class="p_form_title">
                Gruppe zum JumpIn hinzufügen
            </p>
            <p class="p_form">Gruppenname</p>
            <input class="forms_textfield" type="text" name="gruppenname"/>
		    <br>
            <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen"/>
            <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
        </form>
    </div>
</div>