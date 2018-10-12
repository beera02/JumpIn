<?php
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
                }
                else{
                    $invalid = true;
                }
            } 
        }
        if($invalid == true){
            updateArtByID($_SESSION['id_art'], $_POST['aktivitaetsartname']);
            header('Location: aktivitaetsart_edit_choice');
        }
        else{
            header('Location: aktivitaetsart_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetsart_edit_choice');
    }
?>