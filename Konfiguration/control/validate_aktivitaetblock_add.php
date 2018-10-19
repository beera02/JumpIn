<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['name']) & !empty($_POST['writeindate']) & !empty($_POST['writeintime'])){
            if(strlen($_POST['name']) <= 30 & $_POST['aktivitaetsart'] != "null"){   
                $dbname = getActivityentitynameByName($_POST['name']);

	            if ($dbname != $_POST['name']){
                    $invalid = true;
	            }           
            } 
        }
        if($invalid){
            insertActivityentity($_POST['name'], getArtIDByName($_POST['aktivitaetsart']), validateDateTime($_POST['writeindate'], $_POST['writeintime']));
            header('Location: aktivitaetblock');
        }
        else{
            header('Location: aktivitaetblock_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: aktivitaetblock');
    }
?>