<?php
    $_SESSION['error'] = NULL;
    $validated = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!$_FILES['bild']['name'] == ""){
            if(!empty($_POST['steckbrief'])){
                $x = 0;
                $y = 0;
                foreach($_POST['steckbrief'] as $validate){
                    $x++;
                    if(!empty($_POST[''.$validate.''])){
                        if(strlen($_POST[''.$validate.'']) <= 300){
                            $y++;
                        }
                    }
                }
                if($x == $y){
                    $allowed =  array('jpeg','png' ,'jpg');
                    $filename = $_FILES['bild']['name'];
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    if(in_array($extension,$allowed)) {
                        if(filesize($_FILES['bild']['tmp_name']) < 8388608){
                            $validated = true;
                        }
                        else{
                            $_SESSION['error'] = "Zu grosses Bild eingelesen!";
                        }
                    }
                    else{
                        $_SESSION['error'] = "Das eingelesene File ist kein Bild!";
                    }
                }
                else{
                    $_SESSION['error'] = "Nicht alle Kategorien im Steckbrief wurden richtig ausgefüllt!";
                }
            }
            else{
                $_SESSION['error'] = "Es wurden keine Kategorien im Steckbrief ausgefüllt!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurde kein Bild angegeben!";
        }
        if($validated == true){
            var_dump($_FILES['bild']['name']);
            var_dump($_FILES['bild']['tmp_name']);
            $content = file_get_contents($_FILES['bild']['tmp_name']);
            $userid = getUserIDByUsername($_SESSION['benutzer_app']);
            updateUserPictureByID($userid, $content);
            foreach($_POST['steckbrief'] as $validate){
                insertCharacteristics($validate, $userid, $_POST[''.$validate.'']);
            }
            header('Location: steckbrief_kategorie_add');
        }
        else{
            header('Location: steckbrief_add');
        }
    }
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: home');
    }
?>