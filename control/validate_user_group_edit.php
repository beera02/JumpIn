<?php
    $dbarray = getDatabase();
    $db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
    $benutzerid = (int)$_SESSION['user_edit'];

    $iterated = array();
    if(!empty($_POST['group'])){
        foreach($_POST['group'] as $checked){
            $sql = ("SELECT id_gruppe FROM GRUPPE WHERE name = '$checked' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $idgruppe = $resultatarray['id_gruppe'];

            $preparedquery = $db->prepare("INSERT INTO BENUTZER_GRUPPE (gruppe_id,benutzer_id) VALUES (?,?)");
            $preparedquery->bind_param("ii", $idgruppe, $benutzerid);
            $preparedquery->execute();

            $iterated[] = $idgruppe;

            header('Location: user_group_edit');
        }
    }
    $gruppenabfrage = $db->query("SELECT * FROM GRUPPE");
    while($row = mysqli_fetch_array($gruppenabfrage)){
        if(!in_array($row['id_gruppe'], $iterated)){
            $gruppeid = $row['id_gruppe'];
            $sql = "DELETE FROM BENUTZER_GRUPPE WHERE gruppe_id = '$gruppeid' AND benutzer_id = '$benutzerid'";
            mysqli_query($db,$sql); 
            $db->close(); 
            header('Location: user_edit_choice');
        }
    }  
?>