<?php
    $_SESSION['error'] = NULL;

    if($_POST['submit_btn'] == "Zurück"){
        header('Location: feedback_statistics');
    }   
?>