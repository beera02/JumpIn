<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['benutzername']) & !empty($_POST['vorname']) & !empty($_POST['name']) & !empty($_POST['passwort']) & !empty($_POST['passwort2'])){
            if(strlen($_POST['benutzername']) <= 30 && strlen($_POST['vorname']) <= 50 && strlen($_POST['name']) <= 50){
                $result = getUserByID($_SESSION['user_edit']);
                
                if($result['benutzername'] != $_POST['benutzername']){
                    $resultatstring = getUsernameByUsername($_POST['benutzername']);
                    if ($resultatstring != $_POST['benutzername']){
                        if($_POST['passwort'] == $_POST['passwort2']){
                            $invalid = true;
                        }
                    }
                }
                else{
                    if($_POST['passwort'] == $_POST['passwort2']){
                        $invalid = true;
                    }
                }

            } 
        }
        if($invalid == true){
            updateUserByID($_SESSION['user_edit'], $_POST['passwort'], $_POST['benutzername'], $_POST['name'], $_POST['vorname']);
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
