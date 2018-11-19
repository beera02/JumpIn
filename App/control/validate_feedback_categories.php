<?php
    if($_POST['submit_btn'] == "Weiter" | $_POST['submit_btn'] == "Abschliessen"){
        if(!empty($_POST['options'])){
            if(!empty($_POST['bemerkung'])){
                if(strlen($_POST['bemerkung']) <= 500){
                    insertUserFeedback(getUserIDByUsername($_SESSION['benutzer_app']), $_POST['feedbackid'], $_POST['options'], $_POST['bemerkung']);
                    if($_POST['submit_btn'] == "Abschliessen"){
                        header('Location: home');
                    }
                    else{
                        $_SESSION['startid'] = intval($_POST['startid']);
                        header('Location: feedback_categories');
                    }
                }
                else{
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
            $_SESSION['startid'] = (intval($_POST['startid']) - 1);
            header('Location: feedback_categories'); 
        }
    }
?>