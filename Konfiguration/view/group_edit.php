<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idgroup = intval($_SESSION['id_gruppe']);
        $datensatz = getGroupByID($idgroup);

        echo '
            <div class="div_form">
                <form action="validate_group_edit" method="post">
                    <p class="p_form_title">
                        Gruppe bearbeiten
                    </p>
        ';
        require_once('error.php');
        echo '
                    <p class="p_form">Gruppenname</p>
                    <input class="forms_textfield" type="text" name="gruppenname" value="'.$datensatz['name'].'"/>
                    <br>
                    <p class="p_form">Level</p>
                    <input class="forms_textfield" type="text" name="level" value="'.$datensatz['level'].'"/>
		            <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            </div>
        ';
    ?>
</div>