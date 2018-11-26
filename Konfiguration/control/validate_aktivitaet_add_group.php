<?php
    $_SESSION['error'] = NULL;
    $aktivitaetid = $_SESSION['activity_add'];

    if(!empty($_POST['group'])){
        foreach($_POST['group'] as $checked){
            $resultatstring = getGroupIDByName($checked);
            insertActivityGroup($resultatstring, $aktivitaetid);
        }
    }
    header('Location: aktivitaet');

?>