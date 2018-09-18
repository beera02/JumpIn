<?php
    $dbarray = getDatabase();
    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
    $invalid = false;

    if(!empty($_POST['benutzername']) && !empty($_POST['vorname']) && !empty($_POST['name']) && !empty($_POST['passwort']) && !empty($_POST['passwort2'])){
        if(strlen($_POST['benutzername']) <= 30 && strlen($_POST['vorname']) <= 50 && strlen($_POST['name']) <= 50){
            $name = $_POST['name'];
            $vorname = $_POST['vorname'];
            $benutzername = $_POST['benutzername'];
            $passwort = $_POST['passwort'];
            $passwort2 = $_POST['passwort2'];

            $sql = ("SELECT benutzername FROM BENUTZER WHERE benutzername = '$benutzername' LIMIT 1");
	        $resultat = $db->query($sql);
	        $resultatarray = mysqli_fetch_assoc($resultat);
            $resultatstring = $resultatarray['benutzername'];
                
	        if ($resultatstring != $benutzername){
                if($passwort == $passwort2){
                    $invalid = true;
                }
	        }
        } 
    }   

    if($invalid == true){
        $hash = hash('sha256', $passwort . $benutzername);
        $preparedquery = $db->prepare("INSERT INTO BENUTZER (id_benutzer, benutzername, passwort, name, vorname) VALUES (NULL,?,?,?,?)");
        $preparedquery->bind_param("ssss", $benutzername, $hash, $name, $vorname);
        $preparedquery->execute();

        $sql = ("SELECT id_benutzer FROM BENUTZER WHERE benutzername = '$benutzername' LIMIT 1");
        $resultat = $db->query($sql);
        $resultatarray = mysqli_fetch_assoc($resultat);
        $resultatstring = $resultatarray['id_benutzer'];

        $_SESSION['user'] = $resultatstring;
        header('Location: user_add_group_add');
    }
    else{
        header('Location: user_add');
    }
    $db->close();
?>