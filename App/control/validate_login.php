<?php
    $invalid = false;

    if(!(empty($_POST['passwort'])) & !(empty($_POST['benutzername']))){
        $dbpasswort = getPasswordByUsername($_POST['benutzername']);
        $usrpasswort = hash('sha256', $_POST['passwort'] . $_POST['benutzername']);
        
        if($usrpasswort == $dbpasswort){
            $invalid = true;
        }
    }
    
    if($invalid){
        $_SESSION['benutzer_app'] = $_POST['benutzername'];
        $_SESSION['invalidfiles'] = array("steckbrief_add", "validate_steckbrief_add", "steckbrief_kategorie_add", "validate_steckbrief_kategorie_add", "steckbrief", "steckbrief_view", "validate_steckbrief_order", "validate_steckbrief_loeschen");
        $_SESSION['notUserUsers'] = array("admin");
        $_SESSION['notGroupGroups'] = array("admin");
        header('Location: home');
    }
    else{
        header('Location: login');
    }
?>