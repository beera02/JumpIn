<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['frage']) & !empty($_POST['anzahloptionen'])){
            if(strlen($_POST['frage']) <= 300 & ctype_digit($_POST['anzahloptionen'])){
                if(((int)$_POST['anzahloptionen']) > 0){
                    $invalid = true;
                }              
            } 
        }
        if($invalid == true){
            updateFeedbackCategory($_SESSION['feedbackkategorie_edit'], $_POST['frage'], $_POST['anzahloptionen']);
            header('Location: feedback_edit_optionen');
        }
        else{
            header('Location: feedback_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: feedback_edit_choice');
    }
?>