<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <form action="validate_user_add" method="post">
            <p class="p_form_title">
                Benutzer zum JumpIn hinzufügen
            </p>
            <p class="p_form">Name</p>
            <input class="forms_textfield" type="text" name="name" required/>
		    <br>
		    <p class="p_form">Vorname</p>
		    <input class="forms_textfield" type="text" name="vorname" required/>
            <br>
            <p class="p_form">Benutzername</p>
		    <input class="forms_textfield" type="text" name="benutzername" required/>
            <br>
            <p class="p_form">Passwort</p>
		    <input class="forms_textfield" type="password" name="passwort" required/>
            <br>
            <p class="p_form">Passwort wiederholen</p>
	    	<input class="forms_textfield" type="password" name="passwort2" required/>
            <br>
            <button class="button_zurück" onclick="history.back()">Zurück</button>
            <input class="button_weiter" type="submit" value="Weiter"/>
        </form>
    </div>
</div>