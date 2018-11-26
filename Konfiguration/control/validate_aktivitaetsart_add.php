<?php
    $_SESSION['error'] = NULL;
    $invalid = false;
    $aktivitaetsartname;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['aktivitaetsartname'])){
            $aktivitaetsartname = htmlspecialchars($_POST['aktivitaetsartname']);
            if(strlen($aktivitaetsartname) <= 30){              
                $dbArtname = getArtnameByArtname($aktivitaetsartname);

	            if ($dbArtname != $aktivitaetsartname){
                    $invalid = true;
                }
                else{
                    $_SESSION['error'] = "Aktivitätsart mit diesem Aktivitätsartname existiert bereits!";
                }
            }
            else{
                $_SESSION['error'] = "Der Aktivitätsartname ist zu lang! Max. 30 Zeichen!";
            }
        }
        else{
            $_SESSION['error'] = "Es wurden nicht alle Felder ausgefüllt!";
        }
        if($invalid){
            if($_POST['einschreiben'] == "true"){
                insertArt($aktivitaetsartname, 1);
                header('Location: aktivitaetsart');
            }
            else if($_POST['einschreiben'] == "false"){
                insertArt($aktivitaetsartname, 0);
                header('Location: aktivitaetsart');
            }
            else{
                header('Location: aktivitaetsart_add');
            }
        }
        else{
            header('Location: aktivitaetsart_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetsart');
    }
?>