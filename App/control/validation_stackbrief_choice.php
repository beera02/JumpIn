<?php
    $validation = 0;
    $characteristics = getCharacteristicsByUserID(getUserIDByUsername($_SESSION['benutzer']));
    while($row = mysqli_fetch_assoc($characteristics)){
        $validation++;
    }
    if($validation > 0){
        header('Location: steckbrief');
    }
    else{
        header('Location: steckbrief_add');
    }
?>