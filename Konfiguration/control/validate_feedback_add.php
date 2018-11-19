<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['frage']) & !empty($_POST['anzahloptionen']) & !empty($_POST['aufschaltsdate']) & !empty($_POST['aufschaltszeit'])){
            if(strlen($_POST['frage']) <= 300 & ctype_digit($_POST['anzahloptionen'])){
                if(((int)$_POST['anzahloptionen']) > 0){
                    $invalid = true;
                }              
            } 
        }
        if($invalid){
            insertFeedbackCategory($_POST['frage'], $_POST['anzahloptionen'], validateDateTime($_POST['aufschaltsdate'], $_POST['aufschaltszeit']));
            header('Location: feedback_add_optionen');
        }
        else{
            header('Location: feedback_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: feedback');
    }
?>