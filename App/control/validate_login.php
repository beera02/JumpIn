<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $benutzername;

    if(!(empty($_POST['passwort'])) & !(empty($_POST['benutzername']))){
        $benutzername = htmlspecialchars($_POST['benutzername']);
        $dbpasswort = getPasswordByUsername($benutzername);
        $usrpasswort = hash('sha256', $_POST['passwort'] . $benutzername);
        
        if($usrpasswort == $dbpasswort){
            $invalid = true;
        }
    }
    
    if($invalid){
        $_SESSION['benutzer_app'] = $benutzername;
        $_SESSION['invalidfiles'] = array("steckbrief_add", "validate_steckbrief_add", "steckbrief_kategorie_add", "validate_steckbrief_kategorie_add", "steckbrief", "steckbrief_view", "validate_steckbrief_order", "validate_steckbrief_loeschen");
        $_SESSION['notUserUsers'] = array("admin");
        $_SESSION['notGroupGroups'] = array("admin");
        header('Location: home');
    }
    else{
        $_SESSION['error'] = "Unbekannter Benutzername und/oder falsches Passwort!";
        header('Location: login');
    }
?>