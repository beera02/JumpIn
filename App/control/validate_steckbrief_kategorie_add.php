<?php
    $_SESSION['error'] = NULL;
    $validated = false;
    $steckbriefkategoriename;
    $antwort;

    if($_POST['submit_btn'] == "Erstellen"){
        $einzeiler = 1;
        if(!empty($_POST['steckbriefkategoriename']) & !empty($_POST['einzeiler'])  & !empty($_POST['antwort'])){
            $steckbriefkategoriename = htmlspecialchars($_POST['steckbriefkategoriename']);
            $antwort = htmlspecialchars($_POST['antwort']);
            if(strlen($steckbriefkategoriename) <= 30){
                if(strlen($antwort) <= 300){
                    if($_POST['einzeiler'] == "false"){
                        $einzeiler = 0;
                    }
                    $validated = true;
                }
                else{
                    $_SESSION['error'] = "Deine Antwort ist zu lang! Max. 300 Zeichen.";
                }
            }
            else{
                $_SESSION['error'] = "Der Steckbriefkategoriename ist zu lang! Max. 30 Zeichen.";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($validated == true){
            $id = insertCharacteristicsCategory($steckbriefkategoriename, 0, $einzeiler);
            insertCharacteristics($id, getUserIDByUsername($_SESSION['benutzer_app']), $antwort);
            header('Location: steckbrief');
        }
        else{
            header('Location: steckbrief_kategorie_add');
        }
    }
?>