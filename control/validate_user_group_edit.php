<?php
    $benutzerid = (int)$_SESSION['user_edit'];

    $iterated = array();
    if(!empty($_POST['group'])){
        foreach($_POST['group'] as $checked){
            $idgruppe = getGroupIDByName($checked);
            insertUserGroup($idgruppe, $benutzerid);
            $iterated[] = $idgruppe;
        }
    }
    $gruppenabfrage = getAllGroups();
    while($row = mysqli_fetch_array($gruppenabfrage)){
        if(!in_array($row['id_gruppe'], $iterated)){
            $gruppeid = $row['id_gruppe'];
            deleteUserGroup($gruppeid, $benutzerid);
        }
    }  
    header('Location: user');
?>