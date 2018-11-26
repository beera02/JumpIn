<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
        $user = getUserByUsername($_SESSION['feedback_user']);
    ?>
    <div class="div_form">
        <p class="p_form_title">
            <?php
                echo ''.$user['vorname'].' '.$user['name'].'`s Feedback'
            ?>
        </p>
        <?php
            $categories = getAllFeedbackCategories();
            while($row1 = mysqli_fetch_assoc($categories)){
                echo '
                    <div class="div_feedback_statistik_frage">
                        '.$row1['frage'].'
                    </div>
                    <div class="div_feedback_statistik_container">
                ';
                $userfeedback = getUserFeedbackByFeedbackCategoryID($row1['id_feedbackkategorie'], $user['id_benutzer']);
                if(!empty($userfeedback)){
                    while($row2 = mysqli_fetch_assoc($userfeedback)){
                        $option = getOptionByOptionIDAndFeedbackcategoryID($row2['optionen_id'], $row2['feedbackkategorie_id']);
                        echo '
                            <div class="div_feedback_statistik_answer">
                                '.$option['antwort'].'
                            </div>
                            <div class="div_feedback_statistik_bemerkung">
                                '.$row2['bemerkung'].'
                            </div>
                        ';
                    }
                }
                else{
                    echo '<p class="p_feedback_statistik_noanswer">Keine Antwort</p>';
                }
                echo '
                    </div>
                    <br>
                ';
            }
        ?>
        <form action="validate_feedback_statistics_user" method="post">
            <input class="button_zurück" type="submit" name="submit_btn" value="Zurück">
        </form>
    </div>
</div>