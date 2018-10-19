<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['name']) & !empty($_POST['writeindate']) & !empty($_POST['writeintime'])){
            if(strlen($_POST['name']) <= 30 & $_POST['aktivitaetsart'] != "null"){              
                $result = getActivityentityByID($_SESSION['id_aktivitaetblock']);
                
                if($result['name'] != $_POST['name']){
                    $resultatstring = getActivityentitynameByName($_POST['name']);
                    if ($resultatstring != $_POST['name']){
                        $invalid = true;
                    }
                }
                else{
                    $invalid = true;
                }
            } 
        }
        if($invalid){
            updateActivityentity($_SESSION['id_aktivitaetblock'], $_POST['name'], getArtIDByName($_POST['aktivitaetsart']), validateDateTime($_POST['writeindate'], $_POST['writeintime']));
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