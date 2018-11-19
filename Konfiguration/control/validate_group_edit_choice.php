<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_gruppe'] = $_POST['id_gruppe'];
        header('Location: group_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteGroupByID($_POST['id_gruppe']);
        header('Location: group_edit_choice');
    }
?>