<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Gruppen von Benutzer bearbeiten
        </p>
        <form action="validate_user_group_edit" method="post">
            <div class="div_forms_checkbox">
                <?php
                    $dbarray = getDatabase();
                    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
                    $gruppenabfrage = $db->query("SELECT * FROM GRUPPE");

                    $id = $_SESSION['user_edit'];
                    $gruppenbenutzerabfrage = $db->query("SELECT * FROM BENUTZER_GRUPPE WHERE benutzer_id = '$id'");

                    $gruppen = array();
                    $gruppenbenutzer = array();
                    while ($row = mysqli_fetch_array($gruppenabfrage)){
                        $gruppen[] = $row;
                    }            
                    while ($row = mysqli_fetch_array($gruppenbenutzerabfrage)){
                        $gruppenbenutzer[] = $row;
                    }

                    $iteratedarray = [];
                    foreach($gruppen as $rowx){
                        foreach($gruppenbenutzer as $rowy){
                            if($rowx['id_gruppe'] == $rowy['gruppe_id']){
                                echo '
                                    <input class="forms_checkbox" type="checkbox" name="group[]"
                                    value="'.$rowx['name'].'" checked> '.$rowx['name'].'<br>
                                ';
                                $iteratedarray[] = $rowx['id_gruppe'];
                            }
                        }
                        if(!in_array($rowx['id_gruppe'],$iteratedarray)){
                            echo '
                            <input class="forms_checkbox" type="checkbox" name="group[]"
                            value="'.$rowx['name'].'"> '.$rowx['name'].'<br>
                            ';
                        }
                    }
                    $db->close();
                ?>
                <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen">
            </div>
        </form>
    </div>
</div>