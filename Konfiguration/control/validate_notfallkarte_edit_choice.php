<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_notfallkategorie'] = $_POST['id_notfallkategorie'];
        header('Location: notfallkarte_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteEmergencyCategoryByID($_POST['id_notfallkategorie']);
        header('Location: notfallkarte_edit_choice');
    }
?>