<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: user_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteUser($_POST['id_benutzer']);
        $_SESSION['id_benutzer'] = $_POST['id_benutzer'];
        header('Location: user_edit_choice');
    }
?>