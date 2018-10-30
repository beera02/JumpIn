<?php
    if($_POST['submit_btn'] == "Ändern"){
        if($_POST['gruppe'] != "null"){
            $_SESSION['groupselected'] = $_POST['gruppe'];
        }
        header('Location: steckbrief');
    }
    else{
        header('Location: home');
    }
?>