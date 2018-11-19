<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: einschreiben_choice_aktivitaeten');
    }
    else if($_POST['submit_btn'] == "Einschreiben"){
        if(!empty($_POST['aktivitaetid'])){
            $userid = getUserIDByUsername($_SESSION['benutzer_app']);
            $writtenin = getWrittenIn($userid, $_POST['aktivitaetid']);
            if(empty($writtenin['aktivitaet_id'])){
                $writtenins = getWrittenInByActivityID($_POST['aktivitaetid']);
                $participants = 0;
                while($row = mysqli_fetch_assoc($writtenins)){
                    $participants++;
                }
                $aktivitaet = getActivityByID($_POST['aktivitaetid']);
                if($participants < $aktivitaet['anzahlteilnehmer']){
                    insertWritein($userid, $_POST['aktivitaetid']);
                    header('Location: home');
                }
                else{
                    $_SESSION['error'] = "Das maximale Teilnehmerzahl wurde bereits erreicht! Du musst dich in einer anderen Aktivität einschreiben!";
                    header('Location: einschreiben');
                }
            }
            else{
                header('Location: home');
            }
        }
        else{
            header('Location: home');
        }
    }
?>