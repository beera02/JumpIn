<?php
    $invalid = 0;
    $validated = array();

    if(!empty($_POST['antwort'])){
        foreach($_POST['antwort'] as $antwort){
            $validated[] = $antwort;
            if(!empty($antwort)){
                if(strlen($antwort) <= 300){
                    $invalid += 1;
                }
            }
        }
    }
    if($invalid == count($validated)){
        deleteAllOptionsByFeedbackID($_SESSION['feedbackkategorie_edit']);
        foreach($validated as $row){
            insertOption($_SESSION['feedbackkategorie_edit'], $row);
        }
        header('Location: feedback');
    }
    else{
        header('Location: feedback_add_optionen');
    }
?>