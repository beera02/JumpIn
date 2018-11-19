<?php
    $_SESSION['error'] = NULL;
    $invalid = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['benutzername']) & !empty($_POST['vorname']) & !empty($_POST['name']) & !empty($_POST['passwort']) & !empty($_POST['passwort2'])){
            if(strlen($_POST['benutzername']) <= 30){
                if(strlen($_POST['vorname']) <= 50){
                    if(strlen($_POST['name']) <= 50){
                        $result = getUserByID($_SESSION['id_benutzer']);
                
                        if($result['benutzername'] != $_POST['benutzername']){
                            $resultatstring = getUsernameByUsername($_POST['benutzername']);
                            if ($resultatstring != $_POST['benutzername']){
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
                            if($_POST['passwort'] == $_POST['passwort2']){
                                $invalid = true;
                            }
                            else{
                                $_SESSION['error'] = "Passwörter sind nicht identisch!";
                            }
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
            updateUserByID($_SESSION['id_benutzer'], $_POST['passwort'], $_POST['benutzername'], $_POST['name'], $_POST['vorname']);
            header('Location: user_group_edit');
        }
        else{
            header('Location: user_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: user_edit_choice');
    }
?>
