<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['name']) & !empty($_POST['info'])){
            if(strlen($_POST['name']) <= 30 & strlen($_POST['info']) <= 300){              
                $invalid = true;
            } 
        }
        if($invalid){
            insertEmergencyCategory($_POST['name'], $_POST['info']);
            header('Location: notfallkarte');
        }
        else{
            header('Location: notfallkarte_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: notfallkarte');
    }
?>