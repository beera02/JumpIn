<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Antwortoptionen zu Feedbackfrage hinzufügen
        </p>
        <?php
            require_once('error.php');
        ?>
        <form action="validate_feedback_add_optionen" method="post">
            <div class="div_forms_checkbox">
                <?php
                    $feedbackcategory = getFeedbackCategoryByID($_SESSION['feedback_add']);
                    for($i = 1; $i <= $feedbackcategory['anzahloptionen']; $i++){
                        echo '<p class="p_form">Option '.$i.'</p>
                            <textarea class="forms_textarea" name="antwort[]" maxlength="300"></textarea>
                        ';
                    }
                ?>
                <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen">
            </div>
        </form>
    </div>
</div>