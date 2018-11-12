<?php
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: einschreiben_choice_aktivitaeten');
    }
    else if($_POST['submit_btn'] == "Einschreiben"){
        if(!empty($_POST['aktivitaetid'])){
            $userid = getUserIDByUsername($_SESSION['benutzer_app']);
            $writtenin = getWrittenIn($userid, $_POST['aktivitaetid']);
            if(empty($writtenin['aktivitaet_id'])){
                insertWritein($userid, $_POST['aktivitaetid']);
            }
        }
        header('Location: home');
    }
?>