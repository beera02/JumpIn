<?php
    $dbarray = getDatabase();
    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
    $invalid = false;

    if(!(empty($_POST['passwort'])) && !(empty($_POST['benutzername']))){
        $benutzername = $_POST['benutzername'];
        $passwort = $_POST['passwort'];

        $passwortabfrage = $db->query("SELECT passwort FROM BENUTZER
            WHERE benutzername = '$benutzername' LIMIT 1");
        $passwortabfragearray = mysqli_fetch_assoc($passwortabfrage);
        $dbpasswort = $passwortabfragearray['passwort'];
        $usrpasswort = hash('sha256', $passwort . $benutzername);
        
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