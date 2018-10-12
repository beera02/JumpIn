<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $idactivity = intval($_SESSION['id_aktivitaet']);
        $datensatz = getActivityByID($idactivity);

        echo '
        <div class="div_form">
            <form action="validate_aktivitaet_edit" method="post">
                <p class="p_form_title">
                    Aktivität bearbeiten
                </p>
                <p class="p_form">Aktivitätsname</p>
                <input class="forms_textfield" type="text" name="aktivitaetsname" value="'.$datensatz['aktivitaetsname'].'"/>
                <br>
                <p class="p_form">Aktivitätsart</p>
                <select class="forms_dropdown" name="aktivitaetsart">
                    '.getArt().'
                </select>
                <br>
                <p class="p_form">Treffpunkt</p>
                <input class="forms_textfield" type="text" name="treffpunkt" value="'.$datensatz['treffpunkt'].'"/>
                <br>
                <p class="p_form">Info</p>
                <textarea class="forms_textarea" name="info" maxlength="500">'.$datensatz['info'].'</textarea>
                <br>
                <p class="p_form">Einschreiben</p>
                '.getEinschreiben($datensatz['einschreiben']).'
                <br>
                <p class="p_form">Startzeit</p>
                <input class="forms_date" type="date" name="startdate" value="'.returnDate($datensatz['startzeit']).'"/>
                <input class="forms_time" type="time" name="starttime" value="'.returnTime($datensatz['startzeit']).'"/>
                <br>
                <p class="p_form">Endzeit</p>
                <input class="forms_date" type="date" name="enddate" value="'.returnDate($datensatz['endzeit']).'"/>
                <input class="forms_time" type="time" name="endtime" value="'.returnTime($datensatz['endzeit']).'"/>
                <br>
                <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        <div>
        ';

        function getArt(){
            $allarts = getAllArts();
            while($row = mysqli_fetch_assoc($allarts)){
                if($row['id_art'] == $datensatz['art_id']){
                    return '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>';
                }
                else{
                    return '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
            }
        }

        function getEinschreiben($einschreiben){
            if($einschreiben == '1'){
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einschreiben" value="true" checked>
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einschreiben" value="false">
                    <label for="false">Nein</label>';
            }
            else{
                return '<input id="froms_radio_left" class="forms_radio" type="radio" name="einschreiben" value="true">
                    <label for="true">Ja</label>
                    <input class="forms_radio" type="radio" name="einschreiben" value="false" checked>
                    <label for="false">Nein</label>';
            }

        }
    ?>
</div>