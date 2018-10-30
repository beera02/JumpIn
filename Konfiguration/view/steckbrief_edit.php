<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idsteckbrief = intval($_SESSION['id_steckbriefkategorie']);
        $datensatz = getCharacteristicsCategoriesByID($idsteckbrief);

        echo '
            <div class="div_form">
                <form action="validate_steckbrief_edit" method="post">
                    <p class="p_form_title">
                        Steckbriefkategorie bearbeiten
                    </p>
                    <p class="p_form">Steckbriefkategoriename</p>
                    <input class="forms_textfield" type="text" name="name" pattern="[a-zA-ZäöüÄÖÜß]{30}" value="'.$datensatz['name'].'"/>
                    <br>
                    <p class="p_form">Obligatorisch</p>
                    '.getObligation($datensatz['obligation']).'
                    <br>
                    <p class="p_form">Einzeiler</p>
                    '.getEinzeiler($datensatz['einzeiler']).'
                    <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            </div>
        ';

        function getObligation($obligation){
            if($obligation == 1){
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="obligation" value="true" checked>
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="obligation" value="false">
                    <label for="false">Nein</label>
                ';
            }
            else{
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="obligation" value="true">
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="obligation" value="false" checked>
                    <label for="false">Nein</label>
                ';
            }

        }

        function getEinzeiler($einzeiler){
            if($einzeiler == 1){
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einzeiler" value="true" checked>
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einzeiler" value="false">
                    <label for="false">Nein</label>
                ';
            }
            else{
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einzeiler" value="true">
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einzeiler" value="false" checked>
                    <label for="false">Nein</label>
                ';
            }
        }
    ?>
</div>