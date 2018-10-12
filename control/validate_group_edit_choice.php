<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: group_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteGroupByID($_POST['id_gruppe']);
        $_SESSION['id_gruppe'] = $_POST['id_gruppe'];
        header('Location: group_edit_choice');
    }
?>