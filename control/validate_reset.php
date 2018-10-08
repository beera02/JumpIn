<?php
    if($_POST['submit_btn'] == "Reset"){
        resetJumpin();
        header('Location: allgemein');
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: allgemein');
    }
?>