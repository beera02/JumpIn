<?php
    $startid;
    if(empty($_POST['startid'])){
        $startid = intval($_SESSION['startid']);
    }
    else{
        $startid = intval($_POST['startid']);
    }
    if(!empty($startid)){
        $feedbackcategory;
        $feedbackcategories = getAllFeedbackCategories();
        if(!empty($feedbackcategories)){
            $counter = 1;
            while($row = mysqli_fetch_assoc($feedbackcategories)){
                if($counter == $startid){
                    $feedbackcategory = $row;
                }
                $counter++;
            }
            $width = round((100 / ($counter - 1)) * $startid, 1);
            $margin = $width / 2;
            echo '
                <form action="validate_feedback_categories" method="post">
                    <div class="div_progress">
                        <span style="width: '.$width.'%"><p class="p_progress" style="margin-left:'.$margin.'%;">'.$width.'%</p></span>
                    </div>
                    <h2>'.$feedbackcategory['frage'].'</h2>
            ';
            $options = getAllOptionsByFeedbackID($feedbackcategory['id_feedbackkategorie']);
            while($row = mysqli_fetch_assoc($options)){
                echo '
                    <input class="forms_radio" type="radio" name="options"
                    value="'.$row['id_optionen'].'"> '.$row['antwort'].'<br>
                ';
            }
            echo '
                    <p class="p_form">Bemerkung (optional)</p>
                    <textarea class="forms_textarea" name="bemerkung" maxlength="500"></textarea>
                    <input type="hidden" name="startid" value="'.($startid+1).'"/>
                    <input type="hidden" name="feedbackid" value="'.$feedbackcategory['id_feedbackkategorie'].'"/>
            ';
            if($startid == ($counter - 1)){
                echo '
                        <input class="button_weiter" type="submit" name="submit_btn" value="Abschliessen"/>
                    </form>
                ';
            }
            else{
                echo '
                        <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
                    </form>
                ';
            }
        }
        else{
            header('Location: home');
        }
    }
?>