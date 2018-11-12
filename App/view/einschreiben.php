<?php
    if(!empty($_POST['id'])){
        $activity = getActivityByID($_POST['id']);
        echo '
            <h2>In Aktivität einschreiben</h2>
            <p class="p_form">Aktivitätsname</p>
            <p class="p_details">
                '.$activity['aktivitaetsname'].'
            </p>
            <br>
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
            $anzahlteilnehmer = 0;
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
                $anzahlteilnehmer++;
            }
            if($anzahlteilnehmer == 0){
                echo '
                    <div id="no_participants">
                        <p id="p_no_participants">
                            Keine Teilnehmer
                        </p>
                    </div>
                ';
            }
            else{
                echo '
                    <br>
                ';
            }
        }
        echo ' 
        <div id="modal_einschreiben" class="modal">
            <div class="modal_einschreiben_content">
                <span class="modal_einschreiben_close">&times;</span>
                <p>
                    Du kannst dich in diesem Aktivitätsblock nur für <b>1</b> Aktivität einschreiben. Möchtest du dich trotzdem für die Aktivität <b>'.$activity['aktivitaetsname'].'</b> einschreiben?
                </p>
                <button id="button_abbrechen" class="button_zurück_modal">Abbrechen</button>
                <form action="validate_einschreiben" method="post">
                    <input type="hidden" name="aktivitaetid" value="'.$activity['id_aktivitaet'].'">
                    <input class="button_weiter_modal" type="submit" name="submit_btn" value="Einschreiben"/>
                </form>
             </div>
        </div>
        <form action="validate_einschreiben" method="post">
            <input class="button_zurück_einschreiben" type="submit" name="submit_btn" value="Zurück"/>
        </form>
        <button id="modal_einschreiben_button" class="button_weiter_modal">Einschreiben</button>
        ';
    }
    else{
        header('Location: home');
    }
?>
<script>
    var modal = document.getElementById('modal_einschreiben');
    var btn = document.getElementById("modal_einschreiben_button");
    var btn2 = document.getElementById("button_abbrechen");
    var span = document.getElementsByClassName("modal_einschreiben_close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    btn2.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    } 
</script>