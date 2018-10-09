<?php
    $invalid = false;
    $einschreiben = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['aktivitaetsname']) & !empty($_POST['treffpunkt']) & !empty($_POST['startdate']) & !empty($_POST['starttime']) & !empty($_POST['enddate']) & !empty($_POST['endtime'])){
            if($_POST['aktivitaetsart'] != "null"){
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
                    $_SESSION['info'] = $_POST['info'];
                }
                header('Location: aktivitaet_add_einschreiben');
            }
            else{
                $validatedarray = validateActivity($_POST['aktivitaetsart'], $_POST['startdate'], $_POST['starttime'], $_POST['enddate'], $_POST['endtime'], NULL, NULL);
                if(empty($_POST['info'])){
                    insertActivity($_POST['aktivitaetsname'], $validatedarray['art_id'], $_POST['treffpunkt'], 0, NULL, NULL, $validatedarray['startzeit'], $validatedarray['endzeit'], NULL);
                }
                else{
                    insertActivity($_POST['aktivitaetsname'], $validatedarray['art_id'], $_POST['treffpunkt'], 0, NULL, NULL, $validatedarray['startzeit'], $validatedarray['endzeit'], $_POST['info']);
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