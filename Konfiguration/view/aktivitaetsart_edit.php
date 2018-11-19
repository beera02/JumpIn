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
        ';
        require_once('error.php');
        echo '
                    <p class="p_form">Aktivitätsartname</p>
                    <input class="forms_textfield" type="text" name="aktivitaetsartname"  value="'.$datensatz['name'].'"/>
                    <br>
                    <p class="p_form">Einschreiben</p>
                    '.getEinschreiben($datensatz['einschreiben']).'
                    <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            </div>
        ';

        function getEinschreiben($einschreiben){
            if($einschreiben == '1'){
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einschreiben" value="true" checked>
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einschreiben" value="false">
                    <label for="false">Nein</label>';
            }
            else{
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einschreiben" value="true">
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einschreiben" value="false" checked>
                    <label for="false">Nein</label>';
            }

        }
    ?>
</div>