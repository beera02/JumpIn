<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_notfallkategorie'] = $_POST['id_notfallkategorie'];
        header('Location: notfallkarte_edit');
    }      
    else if($_POST['submit_btn'] == "Löschen"){
        deleteEmergencyCategoryByID($_POST['id_notfallkategorie']);
        header('Location: notfallkarte_edit_choice');
    }
    else{
        header('Location: home');
    }
?>