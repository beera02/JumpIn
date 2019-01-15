<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_benutzer'] = $_POST['id_benutzer'];
        header('Location: user_edit');
    }      
    else if($_POST['submit_btn'] == "Löschen"){
        deleteUser($_POST['id_benutzer']);
        header('Location: user_edit_choice');
    }
    else{
        header('Location: home');
    }
?>