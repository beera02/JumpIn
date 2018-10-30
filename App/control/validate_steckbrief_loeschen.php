<?php
    if($_POST['submit_btn'] == "Löschen"){
        deleteCharacteristicsCategoryByID($_POST['kategorielöschen']);
        header('Location: steckbrief_view');
    }
?>