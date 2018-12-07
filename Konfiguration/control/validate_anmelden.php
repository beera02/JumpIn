<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $benutzername;

    if($_POST['submit_btn'] == 'Login'){
        if(!(empty($_POST['passwort'])) & !(empty($_POST['benutzername']))){
            $benutzername = htmlspecialchars($_POST['benutzername']);
            $dbpasswort = getPasswordByUsername($benutzername);
            $usrpasswort = hash('sha256', $_POST['passwort'] . $benutzername);
            
            if($usrpasswort == $dbpasswort){
                $gruppenabfrage = getGroupnameByUsername($benutzername);
                
                while ($gruppenabfragearray = mysqli_fetch_assoc($gruppenabfrage)) {
                    if(strtolower($gruppenabfragearray["gruppenname"]) == "admin"){
                        $invalid = true;
                    }
                    else{
                        $_SESSION['error'] = "Benutzername und/oder Passwort sind nicht richtig!";
                    }
                }
            }
            else{
                $_SESSION['error'] = "Benutzername und/oder Passwort sind nicht richtig!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        
        if($invalid){
            $_SESSION['benutzer'] = $benutzername;
            header('Location: home');
        }
        else{
            header('Location: login');
        }
    }
    else{
        header('Location: login');
    }
?>