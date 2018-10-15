<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_steckbriefkategorie'] = $_POST['id_steckbriefkategorie'];
        header('Location: steckbrief_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteSteckbriefkategorieByID($_POST['id_steckbriefkategorie']);
        header('Location: steckbrief_edit_choice');
    }
?>