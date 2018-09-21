<?php
    $dbarray = getDatabase();
    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
    $benutzerid = (int)$_SESSION['user_add'];

    if($_POST['submit_btn'] == "Zurück"){
        $sql = "DELETE FROM BENUTZER WHERE id_benutzer = '".$benutzerid."'";
        mysqli_query($db,$sql);
        header('Location: user_add');
    }
    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['group'])){
            foreach($_POST['group'] as $checked){
                $sql = ("SELECT id_gruppe FROM GRUPPE WHERE name = '$checked' LIMIT 1");
                $resultat = $db->query($sql);
                $resultatarray = mysqli_fetch_assoc($resultat);
                $resultatstring = $resultatarray['id_gruppe'];

                $preparedquery = $db->prepare("INSERT INTO BENUTZER_GRUPPE (gruppe_id,benutzer_id) VALUES (?,?)");
                $preparedquery->bind_param("ii", $resultatstring, $benutzerid);
                $preparedquery->execute();
            }
            header('Location: user');
        }
    }
    $db->close();
?>