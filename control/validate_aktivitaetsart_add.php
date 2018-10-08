<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['aktivitaetsartname'])){
            if(strlen($_POST['aktivitaetsartname']) <= 30){              
                $dbArtname = getArtnameByArtname($_POST['aktivitaetsartname']);
    
	            if ($dbArtname != $_POST['aktivitaetsartname']){
                    $invalid = true;
	            }
            } 
        }
        if($invalid == true){
            insertArt($_POST['aktivitaetsartname']);
            header('Location: aktivitaetsart');
        }
        else{
            header('Location: aktivitaetsart_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetsart');
    }
?>