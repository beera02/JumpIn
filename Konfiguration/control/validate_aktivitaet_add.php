<?php
    $invalid = false;
    $einschreiben = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['aktivitaetsname']) & !empty($_POST['treffpunkt']) & !empty($_POST['startdate']) & !empty($_POST['starttime']) & !empty($_POST['enddate']) & !empty($_POST['endtime'])){
            if(strlen($_POST['aktivitaetsname']) <= 30 & strlen($_POST['treffpunkt']) <= 30){
                if($_POST['aktivitaetsart'] != "null"){
                    $invalid = true;

                    if(!empty($_POST['info'])){
                        if(strlen($_POST['info']) <= 500){
                            $_SESSION['info'] = $_POST['info'];
                        }
                    }
                    $resultarray = getArtByName($_POST['aktivitaetsart']);
                    if($resultarray['einschreiben'] == "1"){
                        $einschreiben = true;
                    }
                }
            }
        }
        if($invalid){
            if($einschreiben == true){
                $_SESSION['aktivitaetsname'] = $_POST['aktivitaetsname'];
                $_SESSION['aktivitaetsart'] = $_POST['aktivitaetsart'];
                $_SESSION['treffpunkt'] = $_POST['treffpunkt'];
                $_SESSION['startdate'] = $_POST['startdate'];
                $_SESSION['starttime'] = $_POST['starttime'];
                $_SESSION['enddate'] = $_POST['enddate'];
                $_SESSION['endtime'] = $_POST['endtime'];
                header('Location: aktivitaet_add_einschreiben');
            }
            else{
                if(isset($_SESSION['info'])){
                    insertActivity($_POST['aktivitaetsname'], NULL, getArtIDByName($_POST['aktivitaetsart']), $_POST['treffpunkt'], NULL, validateDateTime($_POST['startdate'], $_POST['starttime']), validateDateTime($_POST['enddate'], $_POST['endtime']), $_SESSION['info']);
                }
                else{
                    insertActivity($_POST['aktivitaetsname'], NULL, getArtIDByName($_POST['aktivitaetsart']), $_POST['treffpunkt'], NULL, validateDateTime($_POST['startdate'], $_POST['starttime']), validateDateTime($_POST['enddate'], $_POST['endtime']), NULL);
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