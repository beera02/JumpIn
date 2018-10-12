<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';

        $id_feedbackkategorie = intval($_POST['id_feedbackkategorie']);
        if($id_feedbackkategorie > 0){
            $feedbackkategorie_id = $id_feedbackkategorie;
        }
        else{
            $feedbackkategorie_id = $_SESSION['feedbackkategorie_edit'];
        }
        $datensatz = getFeedbackCategoryByID($feedbackkategorie_id);

        echo '
            <form action="validate_feedback_edit" method="post">
                <p class="p_form_title">
                    Feedbackkategorie bearbeiten
                </p>
                <p class="p_form">Frage des Feedbacks</p>
		        <textarea class="forms_textarea" name="frage" maxlength="300">'.$datensatz['frage'].'</textarea>
                <br>
                <p class="p_form">Anzahl Antwortoptionen</p>
                <input class="forms_textfield" type="text" name="anzahloptionen" value="'.$datensatz['anzahloptionen'].'"/>
                <br>
                <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
                <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
            </form>
        ';
        $_SESSION['feedbackkategorie_edit'] = $feedbackkategorie_id;
        $_SESSION['feedbackkategorie_oldoptions'] = $datensatz['anzahloptionen'];
    ?>
</div>