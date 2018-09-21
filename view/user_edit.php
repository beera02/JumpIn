<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idbenutzer = intval($_POST['id_benutzer']);
        if($idbenutzer > 0){
            $benutzerid = $idbenutzer;
        }
        else{
            $benutzerid = $_SESSION['user_edit'];
        }
        $datensatz = getUserByID($benutzerid);

        echo '
            <div class="div_form">
                <form action="validate_user_edit" method="post">
                    <p class="p_form_title">
                        Benutzer bearbeiten
                    </p>
                    <p class="p_form">Name</p>
                    <input class="forms_textfield" type="text" name="name" value="'.$datensatz['name'].'"/>
		            <br>
		            <p class="p_form">Vorname</p>
		            <input class="forms_textfield" type="text" name="vorname" value="'.$datensatz['vorname'].'"/>
                    <br>
                    <p class="p_form">Benutzername</p>
		            <input class="forms_textfield" type="text" name="benutzername" value="'.$datensatz['benutzername'].'"/>
                    <br>
                    <p class="p_form">Passwort</p>
		            <input class="forms_textfield" type="password" name="passwort"/>
                    <br>
                    <p class="p_form">Passwort wiederholen</p>
	    	        <input class="forms_textfield" type="password" name="passwort2"/>
                    <br>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        </div>
        ';
        $_SESSION['user_edit'] = $benutzerid;
    ?>
</div>