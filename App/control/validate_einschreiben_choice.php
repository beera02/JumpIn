<?php
    $_SESSION['error'] = NULL;
    if($_POST['submit_btn'] == "Zurück"){
        $_SESSION['error'] = NULL;
        header('Location: home');
    }
?>