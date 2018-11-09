<?php
    if(!empty($_POST['id'])){
        $activityentities = getActivityentityByArtID($_POST['id']);
        while($row1 = mysqli_fetch_assoc($activityentities)){
            if(strtotime(date("Y-m-d H:i:s")) - strtotime($row1['einschreibezeit']) >= 0){
                $userid = getUserIDByUsername($_SESSION['benutzer_app']);
                $activities = getActivityByActivityentityIDAndUserID($row1['id_aktivitaetblock'], $userid);
                while($row2 = mysqli_fetch_assoc($activities)){
                    if(strtotime($row2['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0){
                        echo '
                            <form class="form_home" action="einschreiben_choice_aktivitaeten" method="post">
                                <button class="button_home section'.getArtNameByID($_POST['id']).'">
                                    <p class="p_section">'.$row1['name'].'</p>
                                </button>
                                <input type="hidden" name="id" value="'.$row1['id_aktivitaetblock'].'">
                            </form>
                        ';
                    }
                }    
            }
        }
    }
    else{
        header('Location: home');
    }
?>