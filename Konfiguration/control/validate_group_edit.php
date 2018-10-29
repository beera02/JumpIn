<?php
    $invalid = false;

    if($_POST['submit_btn'] == "Ändern"){
        if(!empty($_POST['gruppenname']) & !empty($_POST['level'])){
            if(strlen($_POST['gruppenname']) <= 30 & ctype_digit($_POST['level'])){
                $result = getGroupByID($_SESSION['id_gruppe']);
                
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
        if($invalid){
            updateGroupByID($_SESSION['id_gruppe'], $_POST['gruppenname'], $_POST['level']);
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