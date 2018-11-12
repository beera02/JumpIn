<?php
    if(empty($_POST['id'])){
        $id = intval($_SESSION['artid']);
        $_SESSION['artid'] = $id;
    }
    else{
        $id = $_POST['id'];
        $_SESSION['artid'] = $id;
    }
    if(!empty($id)){
        $activityentities = getActivityentityByArtID($id);
        while($row1 = mysqli_fetch_assoc($activityentities)){
            if(strtotime(date("Y-m-d H:i:s")) - strtotime($row1['einschreibezeit']) >= 0){
                $userid = getUserIDByUsername($_SESSION['benutzer_app']);
                $activities = getActivityByActivityentityIDAndUserID($row1['id_aktivitaetblock'], $userid);
                while($row2 = mysqli_fetch_assoc($activities)){
                    $writtenin = getWrittenIn($userid, $row2['id_aktivitaet']);
                    if(strtotime($row2['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0 & empty($writtenin['aktivitaet_id'])){
                        echo '
                            <form class="form_home" action="einschreiben_choice_aktivitaeten" method="post">
                                <button class="button_home section'.getArtNameByID($id).'">
                                    <p class="p_section">'.$row1['name'].'</p>
                                </button>
                                <input type="hidden" name="id" value="'.$row1['id_aktivitaetblock'].'">
                            </form>
                        ';
                    }
                }    
            }
        }
        echo '
            <form action="validate_einschreiben_choice" method="post">
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
    }
    else{
        header('Location: home');
    }
?>