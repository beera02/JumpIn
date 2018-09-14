<form action="validate_anmelden" method="post">
	<div>
		<input class="" type="text" name="benutzername" placeholder="Benutzername" required/>
		<input class="" type="password" name="passwort" placeholder="Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Das Passwort muss aus mindestens 8 Zeichen, 1 Zahl und 1 Grossbuchstaben bestehen!" required/>
		<input class="" type="submit" value="Login"/>
	</div>
</form>