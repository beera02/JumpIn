<?php
    $characteristics = 0;
    $array = array();
    $id=getUserIDByUsername($_SESSION['benutzer_app']);
    $allcharacteristics = getCharacteristicsByUserID($id);
    while($row = mysqli_fetch_assoc($allcharacteristics)){
        $characteristics++;
    }

    if(!$characteristics > 0){
        //array_push($array, "steckbrief_add", "validate_steckbrief_add");
        //removeSessionInvalid($array);
        header('Location: steckbrief_add');
    }
    else{
        $characteristics = 0;
        $obligationcharacteristics = getCharacteristicsByObligationAndID($id);
        while($row = mysqli_fetch_assoc($obligationcharacteristics)){
            $characteristics++;
        }
        if(!$characteristics > 0){
            //array_push($array, "steckbrief_add", "validate_steckbrief_add", "steckbrief_kategorie_add", "validate_steckbrief_kategorie_add");
            //removeSessionInvalid($array);
            header('Location: steckbrief_kategorie_add');
        }
        else{
            //array_push($array, "steckbrief_add", "validate_steckbrief_add", "steckbrief_kategorie_add", "validate_steckbrief_kategorie_add", "steckbrief");
            //removeSessionInvalid($array);
            header('Location: steckbrief');
        }
    }
?>