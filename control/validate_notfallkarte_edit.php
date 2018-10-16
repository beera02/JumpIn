<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['name']) & !empty($_POST['info'])){
            if(strlen($_POST['name']) <= 30 & strlen($_POST['info']) <= 300){              
                $invalid = true;
            } 
        }
        if($invalid){
            updateEmergencyCategory($_SESSION['id_notfallkategorie'], $_POST['name'], $_POST['info']);
            header('Location: notfallkarte');
        }
        else{
            header('Location: notfallkarte_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: notfallkarte_edit_choice');
    }
?>