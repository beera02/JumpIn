<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Erstellen"){
        if(!empty($_POST['gruppenname'])){
            if(strlen($_POST['gruppenname']) <= 30){              
                $dbgroupname = getGroupnameByGroupname($_POST['gruppenname']);
    
	            if ($dbgroupname != $_POST['gruppenname']){
                    $invalid = true;
	            }
            } 
        }
        if($invalid){
            insertGroup($_POST['gruppenname']);
            header('Location: group');
        }
        else{
            header('Location: group_add');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: group');
    }
?>