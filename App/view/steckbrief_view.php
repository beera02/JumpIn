<?php
    if(!empty($_POST['id'])){
        if($_POST['id'] == getUserIDByUsername($_SESSION['benutzer_app'])){
            $user = getUserByID($_POST['id']);
            echo '
                <h2>Dein Steckbrief</h2>
                <p class="p_untertitel">Gefällt dir etwas an deinem Steckbrief nicht mehr? Kein Problem, verändere ihn hier.</p>
                <form action="validate_steckbrief_view" method="post">
                    <p class="p_form">Bild ändern</p>
                    <img class="img_steckbrief_details" src="data:image/jpeg;base64,'.base64_encode($user['bild']).'" alt="Profilbild"/>
                    <input class="forms_file_details" type="file" accept=".jpg, .jpeg, .png" name="bild"/>
            ';
            $steckbriefkategorien = getCharacteristicsCategoryByObligation();
            while($row = mysqli_fetch_assoc($steckbriefkategorien)){
                $answerarray = getCharacteristicsByUserIDAndCharacteristicsID($user['id_benutzer'], $row['id_steckbriefkategorie']);
                if($row['einzeiler'] == "1"){
                    echo '
                        <p class="p_form">'.$row['name'].'</p>
                        <input class="forms_login" type="text" name="'.$row['id_steckbriefkategorie'].'" value="'.$answerarray['antwort'].'"/>
                        <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                        <br>
                    ';
                }
                else{
                    echo '
                        <p class="p_form">'.$row['name'].'</p>
                        <textarea class="forms_textarea" name="'.$row['id_steckbriefkategorie'].'" maxlength="300">'.$answerarray['antwort'].'</textarea>
                        <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                        <br>
                    ';
                }
            }
            $steckbriefkategorien = getCharacteristicsByUserIDAndObligation($user['id_benutzer']);
            while($row = mysqli_fetch_assoc($steckbriefkategorien)){
                if($row['einzeiler'] == "1"){
                    echo '
                        <p class="p_form">'.$row['name'].'</p>
                        <input class="forms_login" type="text" name="'.$row['id_steckbriefkategorie'].'" value="'.$row['antwort'].'"/>
                        <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                        <br>
                    ';
                }
                else{
                    echo '
                        <p class="p_form">'.$row['name'].'</p>
                        <textarea class="forms_textarea" name="'.$row['id_steckbriefkategorie'].'" maxlength="300">'.$row['antwort'].'</textarea>
                        <input type="hidden" name="steckbrief[]" value="'.$row['name'].' '.$row['id_steckbriefkategorie'].'"/>
                        <br>
                    ';
                }
            }
            echo '
                    <p class="p_kategorien">
                        Kategorien
                    </p>
                    <input class="button_hinzufügen" type="submit" name="submit_btn" value="Hinzufügen"/>
                    <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen"/>
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            ';
        }
        else{
            $user = getUserByID($_POST['id']);
            echo '
                <h2>Steckbrief von '.$user['vorname'].'</h2>
                <form action="validate_steckbrief_view" method="post">
                    <img class="img_steckbrief_details_dontknow" src="data:image/jpeg;base64,'.base64_encode($user['bild']).'" alt="Profilbild"/>
                    <div class="space_blocker"></div>
            ';
            $steckbriefkategorien = getCharacteristicsCategoryByObligation();
            while($row = mysqli_fetch_assoc($steckbriefkategorien)){
                $answerarray = getCharacteristicsByUserIDAndCharacteristicsID($user['id_benutzer'], $row['id_steckbriefkategorie']);
                echo '
                    <p class="p_form">'.$row['name'].'</p>
                    <p class="p_details">
                        '.$answerarray['antwort'].'
                    </p>
                    <br>
                ';
            }
            $steckbriefkategorien = getCharacteristicsByUserIDAndObligation($user['id_benutzer']);
            while($row = mysqli_fetch_assoc($steckbriefkategorien)){
                echo '
                    <p class="p_form">'.$row['name'].'</p>
                    <p class="p_details">
                        '.$row['antwort'].'
                    </p>
                    <br>
                ';
            }
            echo '
                    <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
                </form>
            ';
        }
    }
    else{
        header('Location: home');
    }
?>