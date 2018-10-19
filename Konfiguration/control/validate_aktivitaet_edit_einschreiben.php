<?php
    $invalid = false;

    if(!empty($_POST['anzahlteilnehmer'])){
        if(ctype_digit($_POST['anzahlteilnehmer']) & $_POST['aktivitaetblock'] != "null"){
            $invalid = true;
        }
    }
    if($invalid){
        if(isset($_SESSION['info'])){
            updateActivity($_SESSION['id_aktivitaet'], $_SESSION['aktivitaetsname'], getActivityentityIDByName($_POST['aktivitaetblock']), getArtIDByName($_SESSION['aktivitaetsart']), $_SESSION['treffpunkt'], $_POST['anzahlteilnehmer'], validateDateTime($_SESSION['startdate'], $_SESSION['starttime']), validateDateTime($_SESSION['enddate'], $_SESSION['endtime']), $_SESSION['info']);
        }
        else{
            updateActivity($_SESSION['id_aktivitaet'], $_SESSION['aktivitaetsname'], getActivityentityIDByName($_POST['aktivitaetblock']), getArtIDByName($_SESSION['aktivitaetsart']), $_SESSION['treffpunkt'], $_POST['anzahlteilnehmer'], validateDateTime($_SESSION['startdate'], $_SESSION['starttime']), validateDateTime($_SESSION['enddate'], $_SESSION['endtime']), NULL);
        }
        unset($_SESSION["info"]);
        header('Location: aktivitaet_edit_group');
    }
    else{
        header('Location: aktivitaet_edit_einschreiben');
    }
?>