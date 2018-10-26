<?php
    $validated = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!$_FILES['bild']['name'] == ""){
            if(!empty($_POST['steckbrief'])){
                $x = 0;
                $y = 0;
                foreach($_POST['steckbrief'] as $validate){
                    $x++;
                    $validatedarray = explode(' ',$validate);
                    $id = $validatedarray[1];
                    if(!empty($_POST[''.$id.''])){
                        if(strlen($_POST[''.$id.'']) <= 300){
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
                            var_dump($_FILES['bild']['tmp_name']);
                        }
                    }
                }
            }
        }
        if($validated == true){
            var_dump($_FILES['bild']['name']);
            var_dump($_FILES['bild']['tmp_name']);
            $content = file_get_contents($_FILES['bild']['tmp_name']);
            $userid = getUserIDByUsername($_SESSION['benutzer']);
            updateUserPictureByID($userid, $content);
            foreach($_POST['steckbrief'] as $validate){
                $validatedarray = explode(' ',$validate);
                $id = $validatedarray[1];
                insertCharacteristics($id, $userid, $_POST[''.$id.'']);
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