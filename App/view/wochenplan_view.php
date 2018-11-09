<?php
    if(!empty($_POST['id'])){
        $activity = getActivityByID($_POST['id']);
        echo '
            <h2>'.$activity['aktivitaetsname'].'</h2>
            <form action="validate_wochenplan_view" method="post">
                <p class="p_form">Treffpunkt</p>
                <p class="p_details">
                    '.$activity['treffpunkt'].'
                </p>
                <br>
            ';
        if($activity['info'] != NULL){
            echo '
                    <p class="p_form">Info</p>
                    <p class="p_details">
                        '.$activity['info'].'
                    </p>
                    <br>
            ';
        }
        echo '
                <p class="p_form">Zeit</p>
                <p class="p_details">
                    '.getDay($activity['startzeit']).' '.getDateString($activity['startzeit']).'
                    <br>
                    '.getHours($activity['startzeit']).' bis '.getHours($activity['endzeit']).'
                </p>
                <br>
        ';
        if($activity['anzahlteilnehmer'] != NULL){
            $teilnehmer = getWrittenInByActivityID($_POST['id']);
            echo '
                <p class="p_form">Teilnehmer</p>
            ';
            while($row = mysqli_fetch_assoc($teilnehmer)){
                $user = getUserByID($row['benutzer_id']);
                echo '
                    <div class="div_wochenplan_view_teilnehmer">
                        <img class="img_wochenplan_view" src="data:image/jpeg;base64,'.base64_encode($user['bild']).'" alt="Profilbild"/>
                        <p class="p_wochenplan_view">'.$user['vorname'].' '.$user['name'].'</p>
                    </div>               
                ';
            }
            echo '
                <br>
            ';
        }
        echo '
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
    }
    else{
        header('Location: wochenplan');
    }
?>