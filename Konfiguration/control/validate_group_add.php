<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $name;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['gruppenname']) & !empty($_POST['level'])){
            $name = htmlspecialchars($_POST['gruppenname']);
            if(strlen($name) <= 30){
                if(ctype_digit($_POST['level'])){
                    $dbgroupname = getGroupnameByGroupname($name);
    
                    if ($dbgroupname != $name){
                        $invalid = true;
                    }
                    else{
                        $_SESSION['error'] = "Gruppe mit diesem Gruppennamen existiert bereits!";
                    }
                }   
                else{
                    $_SESSION['error'] = "Level muss eine Zahl sein! Das höchste Level einer Gruppe eines Benutzers wird beim Steckbrief des Benutzers angezeigt!";
                }         
            }
            else{
                $_SESSION['error'] = "Der Gruppenname ist zu lang! Max. 30 Zeichen!";
            } 
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            insertGroup($name, $_POST['level']);
            header('Location: group');
        }
        else{
            header('Location: group_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: group');
    }
?>