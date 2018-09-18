<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Benutzer zu Gruppen hinzufügen
        </p>
        <form action="validate_user_add_group_add" method="post">
            <div class="div_forms_checkbox">
                <?php
                    $dbarray = getDatabase();
                    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
                    $gruppenabfrage = $db->query("SELECT * FROM GRUPPE");

                    $i = 1;
                    while($row = mysqli_fetch_assoc($gruppenabfrage)){
                        echo '
                            <input class="forms_checkbox" type="checkbox" name="group[]"
                            value="'.$row['name'].'"> '.$row['name'].'<br>
                        ';
                        $i++;
                    }
                    $db->close();
                ?>
                <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen">
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück">
            </div>
        </form>
    </div>
</div>