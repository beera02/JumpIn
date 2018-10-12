<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: notfallkarte_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteEmergencyCategoryByID($_POST['id_notfallkategorie']);
        $_SESSION['id_notfallkategorie'] = $_POST['id_notfallkategorie'];
        header('Location: notfallkarte_edit_choice');
    }
?>