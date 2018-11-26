<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $name;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['name']) & !empty($_POST['writeindate']) & !empty($_POST['writeintime'])){
            $name = htmlspecialchars($_POST['name']);
            if(strlen($name) <= 30){
                if($_POST['aktivitaetsart'] != "null"){
                    $result = getActivityentityByID($_SESSION['id_aktivitaetblock']);
                
                    if($result['name'] != $name){
                        $resultatstring = getActivityentitynameByName($name);
                        if ($resultatstring != $name){
                            $invalid = true;
                        }
                        else{
                            $_SESSION['error'] = "Aktivitätsblock mit diesem Aktivitätsblockname existiert bereits!";
                        }
                    }
                    else{
                        $invalid = true;
                    }
                }
                else{
                    $_SESSION['error'] = "Es wurde keine Aktivitätsart ausgewählt!";
                }       
            }
            else{
                $_SESSION['error'] = "Der Aktivitätsblockname ist zu lang! Max. 30 Zeichen!";
            } 
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            $aktivitaetsartname = htmlspecialchars($_POST['aktivitaetsart']);
            updateActivityentity($_SESSION['id_aktivitaetblock'], $name, getArtIDByName($aktivitaetsartname), validateDateTime($_POST['writeindate'], $_POST['writeintime']));
            header('Location: aktivitaetblock_edit_choice');
        }
        else{
            header('Location: aktivitaetblock_edit');
        }
    }
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetblock_edit_choice');
    }
?>