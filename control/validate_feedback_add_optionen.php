<?php
    $invalid = 0;
    $iterated = array();

    if(!empty($_POST['antwort'])){
        foreach($_POST['antwort'] as $antwort){
            $iterated[] = $antwort;
            if(!empty($antwort)){
                if(strlen($antwort) <= 300){
                    $invalid += 1;
                }
            }
        }
    }
    if($invalid == count($iterated)){
        foreach($iterated as $row){
            insertOption($_SESSION['feedback_add'], $row);
        }
        header('Location: feedback');
    }
    else{
        header('Location: feedback_add_optionen');
    }
?>