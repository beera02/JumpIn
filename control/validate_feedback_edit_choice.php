<?php
    if($_POST['submit_btn'] == "Bearbeiten"){
        header('Location: feedback_edit');
    }      
    if($_POST['submit_btn'] == "Löschen"){
        deleteFeedbackCategoryByID($_POST['id_feedbackkategorie']);
        $_SESSION['id_feedbackkategorie'] = $_POST['id_feedbackkategorie'];
        header('Location: feedback_edit_choice');
    }
?>