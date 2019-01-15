<?php
    $aktivitaet;
    //Hole die richtige AktivitätID. Entweder aus Session oder aus Post
    if(!empty($_POST['id'])){
        $aktivitaet = $_POST['id'];
        $_SESSION['wochenplan_view_id'] = $_POST['id'];
    }
    else{
        $aktivitaet = $_SESSION['wochenplan_view_id'];
    }
    //Wenn die AktivitätID nicht leer ist
    if(!empty($aktivitaet)){
        $activity = getActivityByID($aktivitaet);
        echo '
            <h2>'.$activity['aktivitaetsname'].'</h2>
            <p class="p_form">Treffpunkt</p>
            <p class="p_details">
                '.$activity['treffpunkt'].'
            </p>
            <br>
        ';
        //Wenn die Aktivität eine Info hat
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
        //Wenn die Aktivität zum einschreiben ist
        if($activity['anzahlteilnehmer'] != NULL){
            $teilnehmer = getWrittenInByActivityID($aktivitaet);
            echo '
                <p class="p_form">Teilnehmer</p>
            ';
            //Für jeden Teilnehmer einen link zu seinem Steckbrief echoen
            while($row = mysqli_fetch_assoc($teilnehmer)){
                $user = getUserByID($row['benutzer_id']);
                echo '
                    <form action="validate_wochenplan_steckbrief_view" method="post">
                        <button class="button_wochenplan_steckbrief">
                            <div class="div_wochenplan_view_teilnehmer">
                                <img class="img_wochenplan_view" src="./userimages/'.$user['id_benutzer'].'.png" alt="Profilbild"/>
                                <p class="p_wochenplan_view">'.$user['vorname'].' '.$user['name'].'</p>
                            </div>
                        </button> 
                        <input type="hidden" name="id" value="'.$user['id_benutzer'].'">
                        <input type="hidden" name="mode" value="1">
                    </form>       
                ';
            }
            echo '
                <br>
            ';
        }
        echo '
            <form action="validate_wochenplan_view" method="post">
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
    }
    else{
        header('Location: wochenplan');
    }
?>