<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Gruppen für diese Aktivität bearbeiten
        </p>
        <form action="validate_aktivitaet_edit_group" method="post">
            <div class="div_forms_checkbox">
                <?php
                    $gruppenabfrage = getAllGroups();

                    $id = $_SESSION['id_aktivitaet'];
                    $gruppenaktivitaetabfrage = getAllActivityGroupsByActivityID($id);

                    $gruppen = array();
                    $gruppenaktivitaeten = array();
                    while ($row = mysqli_fetch_array($gruppenabfrage)){
                        $gruppen[] = $row;
                    }            
                    while ($row = mysqli_fetch_array($gruppenaktivitaetabfrage)){
                        $gruppenaktivitaeten[] = $row;
                    }

                    $iteratedarray = [];
                    foreach($gruppen as $rowx){
                        foreach($gruppenaktivitaeten as $rowy){
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
                ?>
                <input class="button_weiter" type="submit" name="submit_btn" value="Ändern">
            </div>
        </form>
    </div>
</div>