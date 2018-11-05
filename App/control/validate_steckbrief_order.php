<?php
    if($_POST['submit_btn'] == "Ändern"){
        if($_POST['gruppe'] != "null"){
            $_SESSION['groupselected'] = $_POST['gruppe'];
        }
        else{
            $_SESSION['groupselected'] = 0;
        }
        header('Location: steckbrief');
    }
    else{
        header('Location: home');
    }
?>