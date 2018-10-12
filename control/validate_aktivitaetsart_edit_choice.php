<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: aktivitaetsart_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteArtByID($_POST['id_art']);
        $_SESSION['id_art'] = $_POST['id_art'];
        header('Location: aktivitaetsart_edit_choice');
    }
?>