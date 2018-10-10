<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $activityid = $_SESSION['aktivitaet_edit'];
        $datensatz = getActivityByID($activityid);

        echo '
            <form action="validate_aktivitaet_edit_einschreiben" method="post">
                <p class="p_form_title">
                    Einschreibeinfos der Aktivität bearbeiten
                </p>
                <p class="p_form">Anzahl Teilnehmer</p>
                <input class="forms_textfield" type="text" name="anzahlteilnehmer" value="'.$datensatz['anzahlteilnehmer'].'"/>
                <br>
                <p class="p_form">Aufschaltzeit zum einschreiben</p>
                <input class="forms_date" type="date" name="writeindate" value="'.validateReturnDate($datensatz['einschreibezeit']).'"/>
                <input class="forms_time" type="time" name="writeintime" value="'.validateReturnTime($datensatz['einschreibezeit']).'"/>
                <br>
                <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
            </form>
        ';

        function validateReturnDate($einschreibezeit){
            if(returnDate($einschreibezeit) == "1970-01-01"){
                return "";
            }
            else{
                return returnDate($einschreibezeit);
            }
        }

        function validateReturnTime($einschreibezeit){
            if(returnTime($einschreibezeit) == "01:00"){
                return "";
            }
            else{
                return returnTime($einschreibezeit);
            }
        }
    ?>
</div>