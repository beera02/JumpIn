<?php
    $validated = false;

    if($_POST['submit_btn'] == "Erstellen"){
        $einzeiler = 1;
        if(!empty($_POST['steckbriefkategoriename']) & !empty($_POST['einzeiler'])  & !empty($_POST['antwort'])){
            if(strlen($_POST['steckbriefkategoriename']) <= 30 & strlen($_POST['antwort']) <= 300){
                if($_POST['einzeiler'] == "false"){
                    $einzeiler = 0;
                }
                $validated = true;
            }
        }
        if($validated == true){
            $id = insertCharacteristicsCategory($_POST['steckbriefkategoriename'], 0, $einzeiler);
            insertCharacteristics($id, getUserIDByUsername($_SESSION['benutzer_app']), $_POST['antwort']);
            header('Location: steckbrief');
        }
        else{
            header('Location: steckbrief_kategorie_add');
        }
    }
?>