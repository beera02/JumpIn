<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Reset"){
        resetJumpin();
        header('Location: allgemein');
    }      
    else if($_POST['submit_btn'] == "Zurück"){
        header('Location: allgemein');
    }
    else{
        header('Location: home');
    }
?>