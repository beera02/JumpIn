<?php
    $db = new Mysqli('localhost', 'jumpin', '1234', 'jumpin');
    $invalid = false;

    if(!(empty($_POST['passwort'])) && !(empty($_POST['benutzername']))){
        $passwortabfrage = $db->query("SELECT passwort FROM benutzer
            WHERE benutzername = '" . $_POST['benutzername'] . "' LIMIT 1");
        $passwortabfragearray = mysqli_fetch_assoc($passwortabfrage);
        $dbpasswort = $passwortabfragearray['passwort'];
        $usrpasswort = hash('sha256', $_POST['passwort'] . $_POST['benutzername']);
        
        if($usrpasswort == $dbpasswort){
            $gruppenabfrage = $db->query("SELECT g.name AS gruppenname FROM gruppe AS g
                INNER JOIN benutzer_gruppe AS bg ON g.id_gruppe=bg.gruppe_id
                INNER JOIN benutzer AS b ON bg.benutzer_id=b.id_benutzer
                WHERE b.benutzername = '" . $_POST['benutzername'] . "'");
            while ($gruppenabfragearray = mysqli_fetch_assoc($gruppenabfrage)) {
                if($gruppenabfragearray["gruppenname"] == "admin"){
                    $invalid = true;
                }
            }
        }
    }
    $db->close();
    
    if($invalid == true){
        $_SESSION['benutzer'] = $_POST['benutzername'];
        header('Location: home');
    }
    else{
        header('Location: login');
    }
?>