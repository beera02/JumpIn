<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idnotfallkategorie = intval($_POST['id_notfallkategorie']);
        if($idnotfallkategorie > 0){
            $notfallkategorieid = $idnotfallkategorie;
        }
        else{
            $notfallkategorieid = $_SESSION['notfallkategorie_edit'];
        }
        $datensatz = getEmergencyCategoryByID($notfallkategorieid);

        echo '
            <form action="validate_notfallkarte_edit" method="post">
                <p class="p_form_title">
                    Notfallkartenkategorie bearbeiten
                </p>
                <p class="p_form">Notfallname</p>
                <input class="forms_textfield" type="text" name="name" value="'.$datensatz['name'].'"/>
                <br>
                <p class="p_form">Notfallinfo</p>
                <input class="forms_textfield" type="text" name="info" value="'.$datensatz['info'].'"/>
                <br>
                <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
        $_SESSION['notfallkategorie_edit'] = $notfallkategorieid;
    ?>
</div>