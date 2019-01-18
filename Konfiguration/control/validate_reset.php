<?php
    //Error Session leeren
    $_SESSION['error'] = NULL;
    //Wenn Reset geklickt wurde
    if($_POST['submit_btn'] == "Reset"){
        //Jumpin zurücksetzen
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