<?php
    $_SESSION['error'] = NULL;
    $validated = false;
    $bild = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['steckbrief'])){
            $x = 0;
            $y = 0;
            foreach($_POST['steckbrief'] as $validate){
                $x++;
                if(!empty($_POST[''.$validate.''])){
                    $steckbrief = htmlspecialchars($_POST[''.$validate.'']);
                    if(strlen($steckbrief) <= 300){
                        $y++;
                    }
                }
            }
            if($x == $y){
                if(!$_FILES['bild']['name'] == ""){
                    $validated = true;
                    $allowed =  array('jpeg','png','jpg');
                    $filename = $_FILES['bild']['name'];
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    var_dump($extension);
                    if(in_array(strtolower($extension),$allowed)) {
                        if(filesize($_FILES['bild']['tmp_name']) < 8388608){
                            $uploaddir = getcwd()."\userimages\ ";
                            $uploaddir = trim($uploaddir);
                            $filename = getUserIDByUsername($_SESSION['benutzer_app']);
                            $uploadfile = $uploaddir.$filename.".png";
                            move_uploaded_file($_FILES['bild']['tmp_name'], $uploadfile);
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
                    $validated = true;
                }
            }
            else{
                $_SESSION['error'] = "Nicht alle Kategorien im Steckbrief wurden richtig ausgefüllt!";
            }
        }
        if($validated){
            $userid = getUserIDByUsername($_SESSION['benutzer_app']);
            foreach($_POST['steckbrief'] as $validate){
                $steckbrief = htmlspecialchars($_POST[''.$validate.'']);
                updateCharacteristics($validate, $userid, $steckbrief);
            }
            header('Location: steckbrief_view');
        }
        else{
            header('Location: steckbrief_view');
        }
    }
    else if($_POST['submit_btn'] == "Kategorie hinzufügen"){
        header('Location: steckbrief_kategorie_add');
    }
    else if($_POST['submit_btn'] == "Zurück"){
        header('Location: steckbrief');
    }
?>