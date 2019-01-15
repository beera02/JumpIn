<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_aktivitaetblock'] = $_POST['id_aktivitaetblock'];
        header('Location: aktivitaetblock_edit');
    }      
    else if($_POST['submit_btn'] == "Löschen"){
        deleteActivityentityByID($_POST['id_aktivitaetblock']);
        header('Location: aktivitaetblock_edit_choice');
    }
    else{
        header('Location: home');
    }
?>