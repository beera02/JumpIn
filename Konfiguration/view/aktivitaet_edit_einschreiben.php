<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $activityid = $_SESSION['id_aktivitaet'];
        $datensatz = getActivityByID($activityid);

        echo '
        <div class="div_form">
            <form action="validate_aktivitaet_edit_einschreiben" method="post">
                <p class="p_form_title">
                    Weitere Informationen für das Einschreiben bearbeiten
                </p>
                <p class="p_form">Aktivitätsblock</p>
                <select class="forms_dropdown" name="aktivitaetblock">
                    <option value="null">-</option>
                    '.getActivityentities($datensatz['aktivitaetsname']).'
                </select>
                <p class="p_form">Anzahl Teilnehmer</p>
                <input class="forms_textfield" type="text" name="anzahlteilnehmer" value="'.$datensatz['anzahlteilnehmer'].'"/>
                <br>
                <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
            </form>
        <div>
        ';
        
        function getActivityentities($id){
            $allarts = getAllActivityEntities();
            $result = '';
            while($row = mysqli_fetch_assoc($allarts)){
                if(getArtIDByName($_SESSION['aktivitaetsart']) == $row['art_id']){
                    if($id == $row['art_id']){
                        $result .= '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>';
                    }
                    else{
                        $result .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }

                }
            }
            return $result;
        }
    ?>
</div>