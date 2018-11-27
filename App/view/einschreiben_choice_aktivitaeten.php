<?php
    if(empty($_POST['id'])){
        $id = intval($_SESSION['aktivitaetblockid']);
        $_SESSION['aktivitaetblockid'] = $id;
    }
    else{
        $id = $_POST['id'];
        $_SESSION['aktivitaetblockid'] = $id;
    }
    if(!empty($id)){
        echo '
            <h2>Aktivitäten zum einschreiben</h2>
            <p class="p_untertitel">Hier kannst du dich in eine Aktivität des Aktivitätblockes <b>'.getActivityentityNameByID($_POST['id']).'</b> einschreiben.</p>
        ';
        $counter = 0;
        $activities = getActivityByActivityentityID($id);
        $userid = getUserIDByUsername($_SESSION['benutzer_app']);
        while($row = mysqli_fetch_assoc($activities)){
            $writtenin = getWrittenIn($userid, $row['id_aktivitaet']);
            if(strtotime($row['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0 & empty($writtenin['aktivitaet_id'])){
                echo '
                    <form action="einschreiben" method="post">
                        <button class="button_steckbrief">
                            <div class="div_einschreiben">
                                <p class="p_steckbrief_name">
                                        '.$row['aktivitaetsname'].'   
                                </p>
                                <p class="p_steckbrief_gruppe">
                                    '.getDateString($row['startzeit']).' '.getHours($row['startzeit']).' - '.getHours($row['endzeit']).' Uhr
                                </p>
                            </div>
                        </button>
                        <input type="hidden" name="id" value="'.$row['id_aktivitaet'].'">
                    </form>
                ';
                $counter++;
            }
        }
        if($counter == 0){

        }
        else if($counter > 0){           
            $array = array();
            array_push($array, "einschreiben", "validate_einschreiben");
            removeSessionInvalid($array);
        }
        echo '
            <form action="validate_einschreiben_choice_aktivitaeten" method="post">
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
    }
    else{
        header('Location: home');
    }



?>