<?php
    $invalid = false;

    if(!empty($_POST['anzahlteilnehmer']) & !empty($_POST['writeindate']) & !empty($_POST['writeintime'])){
        if(ctype_digit($_POST['anzahlteilnehmer'])){
            $invalid = true;
        }
    }
    if($invalid){
        $validatedarray = validateActivity($_SESSION['aktivitaetsart'], $_SESSION['startdate'], $_SESSION['starttime'], $_SESSION['enddate'], $_SESSION['endtime'], $_POST['writeindate'], $_POST['writeintime']);
        if(!empty($_SESSION['info'])){
            updateActivity($_SESSION['id_aktivitaet'], $_SESSION['aktivitaetsname'], $validatedarray['art_id'], $_SESSION['treffpunkt'], 1, $_POST['anzahlteilnehmer'], $validatedarray['einschreibezeit'], $validatedarray['startzeit'], $validatedarray['endzeit'], $_SESSION['info']);
        }
        else{
            updateActivity($_SESSION['id_aktivitaet'], $_SESSION['aktivitaetsname'], $validatedarray['art_id'], $_SESSION['treffpunkt'], 1, $_POST['anzahlteilnehmer'], $validatedarray['einschreibezeit'], $validatedarray['startzeit'], $validatedarray['endzeit'], NULL);
        }
        unset($_SESSION["info"]);
        header('Location: aktivitaet_edit_group');
    }
    else{
        header('Location: aktivitaet_edit_einschreiben');
    }
?>