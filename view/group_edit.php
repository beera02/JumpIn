<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idgroup = intval($_POST['id_gruppe']);
        if($idgroup > 0){
            $groupid = $idgroup;
        }
        else{
            $groupid = $_SESSION['group_edit'];
        }
        $datensatz = getGroupByID($groupid);

        echo '
            <div class="div_form">
                <form action="validate_group_edit" method="post">
                    <p class="p_form_title">
                        Gruppe bearbeiten
                    </p>
                    <p class="p_form">Gruppenname</p>
                    <input class="forms_textfield" type="text" name="gruppenname" value="'.$datensatz['name'].'"/>
		            <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Ändern"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        </div>
        ';
        $_SESSION['group_edit'] = $groupid;
    ?>
</div>