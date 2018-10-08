<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['gruppenname'])){
            if(strlen($_POST['gruppenname']) <= 30){
                $result = getGroupByID($_SESSION['group_edit']);
                
                if($result['name'] != $_POST['gruppenname']){
                    $resultatstring = getGroupnameByGroupname($_POST['gruppenname']);
                    if ($resultatstring != $_POST['gruppenname']){
                        $invalid = true;
                    }
                }
                else{
                    $invalid = true;
                }
            } 
        }
        if($invalid == true){
            updateGroupByID($_SESSION['group_edit'], $_POST['gruppenname']);
            header('Location: group_edit_choice');
        }
        else{
            header('Location: group_edit');
        }
    }      
    if($_POST['submit_btn'] == "Zurück"){
        header('Location: group_edit_choice');
    }
?>