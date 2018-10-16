<?php
    $benutzerid = (int)$_SESSION['user_add'];

    if($_POST['submit_btn'] == "Zurück"){
        deleteUser($benutzerid);
        header('Location: user_add');
    }
    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['group'])){
            foreach($_POST['group'] as $checked){
                $resultatstring = getGroupIDByName($checked);
                insertUserGroup($resultatstring, $benutzerid);
            }
        }
        header('Location: user');
    }
?>