<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Antwortoptionen von Feedbackfrage bearbeiten
        </p>
        <?php
            require_once('error.php');
        ?>
        <form action="validate_feedback_edit_optionen" method="post">
            <div class="div_forms_checkbox">
                <?php
                    $feedbackcategory = getFeedbackCategoryByID($_SESSION['id_feedbackkategorie']);
                    $options= getAllOptionsByFeedbackID($_SESSION['id_feedbackkategorie']);
                    $x = 1;
                    if($feedbackcategory['anzahloptionen'] < $_SESSION['feedbackkategorie_oldoptions']){
                        while($row = mysqli_fetch_assoc($options)){
                            if($x <= $feedbackcategory['anzahloptionen']){
                                echo '<p class="p_form">Option '.$x.'</p>
                                    <textarea class="forms_textarea" name="antwort[]" maxlength="300">'.$row['antwort'].'</textarea>
                                ';
                            }
                            $x++;
                        }
                    }
                    elseif($feedbackcategory['anzahloptionen'] > $_SESSION['feedbackkategorie_oldoptions']){
                        while($row = mysqli_fetch_assoc($options)){
                            echo '<p class="p_form">Option '.$x.'</p>
                                <textarea class="forms_textarea" name="antwort[]" maxlength="300">'.$row['antwort'].'</textarea>
                            ';
                            $x++;
                        }
                        for($i = 1; $i <= ($feedbackcategory['anzahloptionen'] - $_SESSION['feedbackkategorie_oldoptions']); $i++){
                            echo '<p class="p_form">Option '.$x.'</p>
                                <textarea class="forms_textarea" name="antwort[]" maxlength="300"></textarea>
                            ';
                            $x++;
                        }
                    }
                    else{
                        while($row = mysqli_fetch_assoc($options)){
                            echo '<p class="p_form">Option '.$x.'</p>
                                <textarea class="forms_textarea" name="antwort[]" maxlength="300">'.$row['antwort'].'</textarea>
                            ';
                            $x++;
                        }
                    }
                ?>
                <input class="button_weiter" type="submit" name="submit_btn" value="Ändern">
            </div>
        </form>
    </div>
</div>