<?php
    $invalid = false;
    $einschreiben = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['aktivitaetsname']) & !empty($_POST['treffpunkt']) & !empty($_POST['startdate']) & !empty($_POST['starttime']) & !empty($_POST['enddate']) & !empty($_POST['endtime'])){
            if(strlen($_POST['aktivitaetsname']) <= 30 & strlen($_POST['treffpunkt']) <= 30){
                $invalid = true;
                if($_POST['einschreiben'] == "true"){
                    $einschreiben = true;
                }
            }    
        }
        if($invalid){
            if($einschreiben){
                $_SESSION['info'] = "";
                $_SESSION['aktivitaetsname'] = $_POST['aktivitaetsname'];
                $_SESSION['aktivitaetsart'] = $_POST['aktivitaetsart'];
                $_SESSION['treffpunkt'] = $_POST['treffpunkt'];
                $_SESSION['startdate'] = $_POST['startdate'];
                $_SESSION['starttime'] = $_POST['starttime'];
                $_SESSION['enddate'] = $_POST['enddate'];
                $_SESSION['endtime'] = $_POST['endtime'];
                if(!empty($_POST['info'])){
                    if(strlen($_POST['info']) <= 500){
                        $_SESSION['info'] = $_POST['info'];
                        header('Location: aktivitaet_edit_einschreiben');
                    }
                    else{
                        header('Location: aktivitaet_edit');
                    }
                }
                else{
                    header('Location: aktivitaet_edit_einschreiben');
                }
            }
            else{
                $validatedarray = validateActivity($_POST['aktivitaetsart'], $_POST['startdate'], $_POST['starttime'], $_POST['enddate'], $_POST['endtime'], NULL, NULL);
                if(empty($_POST['info'])){
                    updateActivity($_SESSION['id_aktivitaet'], $_POST['aktivitaetsname'], $validatedarray['art_id'], $_POST['treffpunkt'], 0, NULL, NULL, $validatedarray['startzeit'], $validatedarray['endzeit'], NULL);
                }
                else{
                    updateActivity($_SESSION['id_aktivitaet'], $_POST['aktivitaetsname'], $validatedarray['art_id'], $_POST['treffpunkt'], 0, NULL, NULL, $validatedarray['startzeit'], $validatedarray['endzeit'], $_POST['info']);
                }
                header('Location: aktivitaet_edit_group');
            }
        }
        else{
            header('Location: aktivitaet_edit');
        }
    }
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaet_edit_choice');
    }
?>