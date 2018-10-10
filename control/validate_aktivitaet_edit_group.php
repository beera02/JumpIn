<?php
    $activityid = (int)$_SESSION['aktivitaet_edit'];

    $iterated = array();
    if(!empty($_POST['group'])){
        foreach($_POST['group'] as $checked){
            $idgruppe = getGroupIDByName($checked);
            insertActivityGroup($idgruppe, $activityid);
            $iterated[] = $idgruppe;
        }
    }
    $gruppenabfrage = getAllGroups();
    while($row = mysqli_fetch_array($gruppenabfrage)){
        if(!in_array($row['id_gruppe'], $iterated)){
            $gruppeid = $row['id_gruppe'];
            deleteActivityGroup($gruppeid, $activityid);
        }
    } 
    header('Location: aktivitaet_edit_choice');
?>