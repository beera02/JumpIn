<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $name;
    $vorname;
    $benutzername;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['benutzername']) & !empty($_POST['vorname']) & !empty($_POST['name']) & !empty($_POST['passwort']) & !empty($_POST['passwort2'])){
            $name = htmlspecialchars($_POST['name']);
            $vorname = htmlspecialchars($_POST['vorname']);
            $benutzername = htmlspecialchars($_POST['benutzername']);
            if(strlen($benutzername) <= 30){
                if(strlen($vorname) <= 50){
                    if(strlen($name) <= 50){
                        if(preg_match('/[a-z]/', $_POST["passwort"])){
                            if(preg_match('/[A-Z]/', $_POST["passwort"])){
                                if(preg_match('/\d/', $_POST["passwort"])){
                                    if(strlen($_POST['passwort']) >= 8){ 
                                        $result = getUserByID($_SESSION['id_benutzer']);
                            
                                        if($result['benutzername'] != $benutzername){
                                            $resultatstring = getUsernameByUsername($benutzername);
                                            if ($resultatstring != $benutzername){
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
                                        $_SESSION['error'] = "Das Passwort muss mindestens 8 Zeichen lang sein!";
                                    }
                                }
                                else{
                                    $_SESSION['error'] = "Das Passwort muss eine Zahl beinhalten!";
                                }
                            }
                            else{
                                $_SESSION['error'] = "Das Passwort muss einen Grossbuchstaben beinhalten!";
                            }
                        }
                        else{
                            $_SESSION['error'] = "Das Passwort muss einen Kleinbuchstaben beinhalten!";
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
            updateUserByID($_SESSION['id_benutzer'], $_POST['passwort'], $benutzername, $name, $vorname);
            header('Location: user_group_edit');
        }
        else{
            header('Location: user_edit');
        }
    }      
    else if($_POST['submit_btn'] == "Zurück"){
        header('Location: user_edit_choice');
    }
    else{
        header('Location: home');
    }
?>
