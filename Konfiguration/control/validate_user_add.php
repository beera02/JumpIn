<?php
    $_SESSION['error'] = NULL;
    $invalid = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['benutzername']) & !empty($_POST['vorname']) & !empty($_POST['name']) & !empty($_POST['passwort']) & !empty($_POST['passwort2'])){
            if(strlen($_POST['benutzername']) <= 30){
                if(strlen($_POST['vorname']) <= 50){
                    if(strlen($_POST['name']) <= 50){
                        $dbbenutzername = getUsernameByUsername($_POST['benutzername']);;
    
                        if ($dbbenutzername != $_POST['benutzername']){
                            if($_POST['passwort'] == $_POST['passwort2']){
                                $invalid = true;
                            }
                            else{
                                $_SESSION['error'] = "Passwörter sind nicht identisch!";
                            }
                        }
                        else{
                            $_SESSION['error'] = "Benutzer mit diesem Benutzernamen existiert bereits!";
                        } 
                    }
                    else{
                        $_SESSION['error'] = "Der Name ist zu lang! Max. 50 Zeichen!";
                    }
                } 
                else{
                    $_SESSION['error'] = "Der Vorname ist zu lang! Max. 50 Zeichen!";
                }        
            }
            else{
                $_SESSION['error'] = "Der Benutzername ist zu lang! Max. 30 Zeichen!";
            } 
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            insertUser($_POST['benutzername'], $_POST['passwort'], $_POST['name'], $_POST['vorname']);
            $userid = getUserIDByUsername($_POST['benutzername']);
            $_SESSION['user_add'] = $userid;
            header('Location: user_group_add');
        }
        else{
            header('Location: user_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: user');
    }
?>