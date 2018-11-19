<?php
    $_SESSION['error'] = NULL;
    $invalid = false;

    if($_POST['submit_btn'] == "Weiter"){
        if(!empty($_POST['frage']) & !empty($_POST['anzahloptionen']) & !empty($_POST['aufschaltsdate']) & !empty($_POST['aufschaltszeit'])){
            if(strlen($_POST['frage']) <= 300){
                if(ctype_digit($_POST['anzahloptionen'])){
                    $invalid = true;

                }
                else{
                    $_SESSION['error'] = "Anzahloptionen muss eine Zahl sein! Gibt an wie viele Antwortoptionen anschliessend ausgefüllt werden müssen!";
                }            
            }
            else{
                $_SESSION['error'] = "Die Frage des Feedbacks ist zu lang! Max. 300 Zeichen!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            updateFeedbackCategory($_SESSION['id_feedbackkategorie'], $_POST['frage'], $_POST['anzahloptionen'], validateDateTime($_POST['aufschaltsdate'], $_POST['aufschaltszeit']));
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