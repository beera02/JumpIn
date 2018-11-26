<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Weiter" | $_POST['submit_btn'] == "Abschliessen"){
        if(!empty($_POST['options'])){
            if(!empty($_POST['bemerkung'])){
                $bemerkung = htmlspecialchars($_POST['bemerkung']);
                if(strlen($bemerkung) <= 500){
                    insertUserFeedback(getUserIDByUsername($_SESSION['benutzer_app']), $_POST['feedbackid'], $_POST['options'], $bemerkung);
                    if($_POST['submit_btn'] == "Abschliessen"){
                        header('Location: home');
                    }
                    else{
                        $_SESSION['startid'] = intval($_POST['startid']);
                        header('Location: feedback_categories');
                    }
                }
                else{
                    $_SESSION['error'] = "Die Bemerkung ist zu lang! Max. 500 Zeichen.";
                    $_SESSION['startid'] = (intval($_POST['startid']) - 1);
                    header('Location: feedback_categories');
                }
            }
            else{
                insertUserFeedback(getUserIDByUsername($_SESSION['benutzer_app']), $_POST['feedbackid'], $_POST['options'], NULL);
                if($_POST['submit_btn'] == "Abschliessen"){
                    header('Location: home');
                }
                else{
                    $_SESSION['startid'] = intval($_POST['startid']);
                    header('Location: feedback_categories');
                }
            }
        }
        else{
            $_SESSION['error'] = "Es wurde keine Antwort angegeben!";
            $_SESSION['startid'] = (intval($_POST['startid']) - 1);
            header('Location: feedback_categories'); 
        }
    }
?>