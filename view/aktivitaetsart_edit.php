<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idart = intval($_SESSION['id_art']);
        $datensatz = getArtByID($idart);

        echo '
            <div class="div_form">
                <form action="validate_aktivitaetsart_edit" method="post">
                    <p class="p_form_title">
                        Aktivitätsart bearbeiten
                    </p>
                    <p class="p_form">Aktivitätsartname</p>
                    <input class="forms_textfield" type="text" name="aktivitaetsartname" value="'.$datensatz['name'].'"/>
		            <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            </div>
        ';
    ?>
</div>