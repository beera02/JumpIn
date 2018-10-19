<?php
    $invalid = false;

    if(!empty($_POST['anzahlteilnehmer'])){
        if(ctype_digit($_POST['anzahlteilnehmer']) & $_POST['aktivitaetblock'] != "null"){
            $invalid = true;
        }
    }
    if($invalid){
        if(isset($_SESSION['info'])){
            insertActivity($_SESSION['aktivitaetsname'], getActivityentityIDByName($_POST['aktivitaetblock']), getArtIDByName($_SESSION['aktivitaetsart']), $_SESSION['treffpunkt'], $_POST['anzahlteilnehmer'], validateDateTime($_SESSION['startdate'], $_SESSION['starttime']), validateDateTime($_SESSION['enddate'], $_SESSION['endtime']), $_SESSION['info']);
        }
        else{
            insertActivity($_SESSION['aktivitaetsname'], getActivityentityIDByName($_POST['aktivitaetblock']), getArtIDByName($_SESSION['aktivitaetsart']), $_SESSION['treffpunkt'], $_POST['anzahlteilnehmer'], validateDateTime($_SESSION['startdate'], $_SESSION['starttime']), validateDateTime($_SESSION['enddate'], $_SESSION['endtime']), NULL);
        }
        unset($_SESSION["info"]);
        header('Location: aktivitaet_add_group');
    }
    else{
        header('Location: aktivitaet_add_einschreiben');
    }
?>