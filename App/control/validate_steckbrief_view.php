<?php
    $validated = false;
    $bild = false;

    if($_POST['submit_btn'] == "Ändern"){
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
                if(!$_FILES['bild']['name'] == ""){
                    $bild = true;
                    $allowed =  array('jpeg','png' ,'jpg');
                    $filename = $_FILES['bild']['name'];
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    if(in_array($extension,$allowed)) {
                        if(filesize($_FILES['bild']['tmp_name']) < 8388608){
                            $validated = true;
                        }
                    }
                }
                else{
                    $validated = true;
                }
            }
        }
        if($validated){
            $userid = getUserIDByUsername($_SESSION['benutzer_app']);
            if($bild){
                $content = file_get_contents($_FILES['bild']['tmp_name']);
                updateUserPictureByID($userid, $content);
            }
            foreach($_POST['steckbrief'] as $validate){
                updateCharacteristics($validate, $userid, $_POST[''.$validate.'']);
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