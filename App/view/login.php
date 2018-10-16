<h2>Einloggen</h2>
<p class="p_untertitel">Melden Sie sich mit Ihren erhaltenen Benutzerdaten an.</p>
<form action="validate_login" method="post">
	<div id="div_form">
		<p class="p_form">Benutzername</p>
		<input class="forms_login" type="text" name="benutzername" required/>
		<br>
		<p class="p_form">Passwort</p>
		<input class="forms_login" type="password" name="passwort" required/>
        <br>
        <div class="separation_line"></div>
        <div class="div_buttons">
            <input id="button_abbrechen" type="submit" value="Abbrechen"/>
		    <input id="button_login" type="submit" value="Login"/>
        </div>
	</div>
</form>