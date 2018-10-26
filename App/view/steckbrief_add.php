<h2>Erstelle jetzt deinen Steckbrief!</h2>
<form action="validate_steckbrief_add" method="POST" enctype="multipart/form-data">
    <p class="p_form">Bild von dir (PNG, JPG)</p>
    <input class="forms_file" type="file" accept=".jpg, .jpeg, .png" name="bild"/>
<?php
    $steckbriefkategorien = getCharacteristicsCategoryByObligation();
    while($row = mysqli_fetch_assoc($steckbriefkategorien)){
        if($row['einzeiler'] == "1"){
            echo '
                <p class="p_form">'.$row['name'].'</p>
                <input class="forms_login" type="text" name="'.$row['id_steckbriefkategorie'].'" required/>
                <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                <br>
            ';
        }
        else{
            echo '
                <p class="p_form">'.$row['name'].'</p>
                <textarea class="forms_textarea" name="'.$row['id_steckbriefkategorie'].'" maxlength="300"></textarea>
                <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                <br>
            ';
        }
    }
?>
    <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen"/>
    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
</form>