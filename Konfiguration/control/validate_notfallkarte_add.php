<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $name;
    $info;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['name']) & !empty($_POST['info'])){
            $name = htmlspecialchars($_POST['name']);
            $info = htmlspecialchars($_POST['info']);
            if(strlen($name) <= 30){
                if(strlen($info) <= 300){
                    $invalid = true;
                }
                else{
                    $_SESSION['error'] = "Die Notfallinfo ist zu lang! Max. 300 Zeichen!";
                }        
            }
            else{
                $_SESSION['error'] = "Der Notfallname ist zu lang! Max. 30 Zeichen!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            insertEmergencyCategory($name, $info);
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