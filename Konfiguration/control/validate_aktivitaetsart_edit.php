<?php
    $_SESSION['error'] = NULL;
    $invalid = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['aktivitaetsartname'])){
            if(strlen($_POST['aktivitaetsartname']) <= 30){
                $result = getArtByID($_SESSION['id_art']);
                
                if($result['name'] != $_POST['aktivitaetsartname']){
                    $resultatstring = getArtnameByArtname($_POST['aktivitaetsartname']);
                    if ($resultatstring != $_POST['aktivitaetsartname']){
                        $invalid = true;
                    }
                    else{
                        $_SESSION['error'] = "Aktivitätsart mit diesem Aktivitätsartname existiert bereits!";
                    }
                }
                else{
                    $invalid = true;
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
                updateArtByID($_SESSION['id_art'], $_POST['aktivitaetsartname'], 1);
                header('Location: aktivitaetsart_edit_choice');
            }
            else if($_POST['einschreiben'] == "false"){
                updateArtByID($_SESSION['id_art'], $_POST['aktivitaetsartname'], 0);
                header('Location: aktivitaetsart_edit_choice');
            }
            else{
                header('Location: aktivitaetsart_edit');
            }
        }
        else{
            header('Location: aktivitaetsart_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetsart_edit_choice');
    }
?>