<?php
    $invalid = false;

    if(!(empty($_POST['passwort'])) & !(empty($_POST['benutzername']))){
        $dbpasswort = getPasswordByUsername($_POST['benutzername']);
        $usrpasswort = hash('sha256', $_POST['passwort'] . $_POST['benutzername']);
        
        if($usrpasswort == $dbpasswort){
            $gruppenabfrage = getGroupnameByUsername($_POST['benutzername']);
            
            while ($gruppenabfragearray = mysqli_fetch_assoc($gruppenabfrage)) {
                if(strtolower($gruppenabfragearray["gruppenname"]) == "admin"){
                    $invalid = true;
                }
            }
        }
    }
    
    if($invalid){
        $_SESSION['benutzer'] = $_POST['benutzername'];
        header('Location: home');
    }
    else{
        header('Location: login');
    }
?>