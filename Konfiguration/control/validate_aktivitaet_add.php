<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $einschreiben = false;
    $aktivitaetsname;
    $treffpunkt;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['aktivitaetsname']) & !empty($_POST['treffpunkt']) & !empty($_POST['startdate']) & !empty($_POST['starttime']) & !empty($_POST['enddate']) & !empty($_POST['endtime'])){
            $aktivitaetsname = htmlspecialchars($_POST['aktivitaetsname']);
            $treffpunkt = htmlspecialchars($_POST['treffpunkt']);
            if(strlen($aktivitaetsname) <= 30){
                if(strlen($treffpunkt) <= 30){
                    if($_POST['aktivitaetsart'] != "null"){
                        $invalid = true;
    
                        if(!empty($_POST['info'])){
                            $info = htmlspecialchars($_POST['info']);
                            if(strlen($info) <= 500){
                                $_SESSION['info'] = $info;
                            }
                            else{
                                $_SESSION['error'] = "Die Info ist zu lang! Max. 500 Zeichen!";
                            }
                        }
                        $resultarray = getArtByName($_POST['aktivitaetsart']);
                        if($resultarray['einschreiben'] == "1"){
                            $einschreiben = true;
                        }
                    }
                    else{
                        $_SESSION['error'] = "Es wurde keine Aktivitätsart ausgewählt!";
                    }
                }
                else{
                    $_SESSION['error'] = "Der Treffpunkt ist zu lang! Max. 30 Zeichen!";
                }
            }
            else{
                $_SESSION['error'] = "Der Aktivitätsname ist zu lang! Max. 30 Zeichen!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            if($einschreiben == true){
                $_SESSION['aktivitaetsname'] = $aktivitaetsname;
                $_SESSION['aktivitaetsart'] = $_POST['aktivitaetsart'];
                $_SESSION['treffpunkt'] = $treffpunkt;
                $_SESSION['startdate'] = $_POST['startdate'];
                $_SESSION['starttime'] = $_POST['starttime'];
                $_SESSION['enddate'] = $_POST['enddate'];
                $_SESSION['endtime'] = $_POST['endtime'];
                header('Location: aktivitaet_add_einschreiben');
            }
            else{
                if(isset($_SESSION['info'])){
                    insertActivity($aktivitaetsname, NULL, getArtIDByName($_POST['aktivitaetsart']), $treffpunkt, NULL, validateDateTime($_POST['startdate'], $_POST['starttime']), validateDateTime($_POST['enddate'], $_POST['endtime']), $_SESSION['info']);
                }
                else{
                    insertActivity($aktivitaetsname, NULL, getArtIDByName($_POST['aktivitaetsart']), $treffpunkt, NULL, validateDateTime($_POST['startdate'], $_POST['starttime']), validateDateTime($_POST['enddate'], $_POST['endtime']), NULL);
                }
                header('Location: aktivitaet_add_group');
            }
        }
        else{
            header('Location: aktivitaet_add');
        }
    }
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaet');
    }
?>