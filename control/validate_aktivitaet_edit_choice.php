<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: aktivitaet_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteActivityByID($_POST['id_aktivitaet']);
        $_SESSION['id_aktivitaet'] = $_POST['id_aktivitaet'];
        header('Location: aktivitaet_edit_choice');
    }
?>