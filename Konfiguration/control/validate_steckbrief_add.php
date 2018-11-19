<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $obligation = 0;
    $einzeiler = 0;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['name']) & !empty($_POST['obligation']) & !empty($_POST['einzeiler'])){
            if(strlen($_POST['name']) <= 30){              
                $invalid = true;

                if($_POST['obligation'] == "true"){
                    $obligation = 1;
                }
                if($_POST['einzeiler'] == "true"){
                    $einzeiler = 1;
                }
            } 
            else{
                $_SESSION['error'] = "Der Steckbriefkategoriename ist zu lang! Max. 30 Zeichen!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            insertCharacteristicsCategory($_POST['name'], $obligation, $einzeiler);
            header('Location: steckbrief');
        }
        else{
            header('Location: steckbrief_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: steckbrief');
    }
?>