<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Jump-In zurücksetzen
        </p>
        <p class="p_content">
            Bei einem Reset von einem Jump-In passiert folgendes:
        </p>
        <ul class="p_content">
            <li>Alle Benutzer welche nicht der Gruppe Admin/Coach zugeteilt sind werden gelöscht</li>
            <li>Alle Gruppen ausser die Admin Gruppe werden gelöscht</li>
            <li>Alle Aktivitäten werden gelöscht</li>
            <li>Die Feedbackbögen der gelöschten Benutzer werden gelöscht</li>
            <li>Alle Einschreibungen werden gelöscht</li>
            <li>Alle nicht obligatorischen Steckbriefkategorien werden gelöscht</li>
            <li>Alle Steckbriefe werden gelöscht</li>
        </ul>
        <form action="validate_reset" method="post">
            <input class="button_weiter" type="submit" name="submit_btn" value="Reset">
            <input class="button_zurück" type="submit" name="submit_btn" value="Zurück">
        </form>
    </div>
</div>