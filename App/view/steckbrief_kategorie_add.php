<h2>Erzähle noch mehr über dich!</h2>
<p class="p_untertitel">Erstelle deine persönliche Steckbriefkategorie und nutze die Chance noch mehr über dich zu erzählen.</p>
<?php
    require_once('error.php');
?>
<form action="validate_steckbrief_kategorie_add" method="post">
    <p class="p_form">Steckbriefkategoriename</p>
    <input class="forms_login" type="text" name="steckbriefkategoriename" placeholder="Wohnort" pattern="[a-zA-ZäöüÄÖÜß]{1-30}" required/>
    <br>
    <p class="p_form">Einzeilige Antwort</p>
    <div class="div_margin-left">
        <input id="froms_radio_left" type="radio" name="einzeiler" value="true" checked>
        <label for="true">Ja</label>
        <input type="radio" name="einzeiler" value="false">
        <label for="false">Nein</label>
    </div>
    <br>
    <p class="p_form">Deine Antwort</p>
    <textarea class="forms_textarea" name="antwort" maxlength="300" placeholder="Bern"></textarea>
    <br>
    <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen"/>
</form>