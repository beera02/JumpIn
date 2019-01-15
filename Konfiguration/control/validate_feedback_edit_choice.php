<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Bearbeiten"){
        $_SESSION['id_feedbackkategorie'] = $_POST['id_feedbackkategorie'];
        header('Location: feedback_edit');
    }      
    else if($_POST['submit_btn'] == "Löschen"){
        deleteFeedbackCategoryByID($_POST['id_feedbackkategorie']);
        header('Location: feedback_edit_choice');
    }
    else{
        header('Location: home');
    }
?>