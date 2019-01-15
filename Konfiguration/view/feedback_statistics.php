<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Feedback Statistiken
        </p>
        <?php
            $colors = array("286DA8", "CD5360", "B37D4E", "438496", "A895E2", "780CE8", "E8880C", "9B7E84", "67C06B", "362866", "664222", "0D375B", "802731", "A35971", "EC9B24", "009B32", "4A6068", "4E383D", "8E3306", "867A4A");
            $categories = getAllFeedbackCategories();
            while($row1 = mysqli_fetch_assoc($categories)){
                echo '
                    <div class="div_feedback_statistik_frage">
                        '.$row1['frage'].'
                    </div>
                    <div class="div_feedback_statistik_container">
                ';
                $answers = getUserFeedbackCountByFeedbackCategoryID($row1['id_feedbackkategorie']);
                $answercount = $answers['counted'];
                $options = getAllOptionsByFeedbackID($row1['id_feedbackkategorie']);
                $colorscount = 0;
                while($row2 = mysqli_fetch_assoc($options)){
                    if($colorscount <= count($colors)){
                        $color = $colors[$colorscount];
                    }
                    else{
                        $color = "gray";
                    }
                    echo '
                        <div class="div_feedback_statistik_line_container">
                            <div class="div_feedback_statistik_optionen" style="color: #'.$color.';">
                                '.$row2['antwort'].'
                            </div>
                    ';
                    $answercountoption = 0;
                    $userfeedback = getUserFeedbackByOptionIDAndFeedbackCategoryID($row2['id_optionen'], $row1['id_feedbackkategorie']);
                    while($row3 = mysqli_fetch_assoc($userfeedback)){
                        $answercountoption++;
                    }
                    if($answercount != 0){
                        $percentage = round(100*($answercountoption / $answercount), 1);
                        echo '
                                <div class="div_feedback_statistik_antwort" style="width: calc(((100% - 400px)/100)*'.$percentage.'); background-color: #'.$color.';"></div>
                                <p class="p_feedback_statistik_antwort">'.$percentage.'%</p>
                            </div>
                        ';
                    }
                    else{
                        $percentage = 0;
                        echo '
                                <p class="p_feedback_statistik_antwort">'.$percentage.'%</p>
                            </div>
                        ';
                    }
                    $colorscount++;
                }
                echo '
                    </div>
                    <p class="p_feedback_statistik_bemerkungen">
                        Bemerkungen
                    </p>
                ';
                $userbemerkung = getUserFeedbackByFeedbackCategoryIDAndBemerkung($row1['id_feedbackkategorie']);
                while($row4 = mysqli_fetch_assoc($userbemerkung)){
                    if($row4['bemerkung'] != NULL){
                        echo '
                            <div class="div_feedback_statistik_bemerkungen">
                                '.$row4['bemerkung'].'
                            </div>
                        ';
                    }   
                }
                echo '
                    <br>
                    <br>
                ';
            }
        ?>
        <p class="p_form_title">
            Feedback pro Benutzer
        </p>
        <?php
            require_once('error.php');
        ?>
        <p class="p_content">
            Schauen Sie sich das Feedback eines Benutzers genauer an! Suchen können Sie mit dem Benutzernamen.
        </p>
        <?php
            $user = getAllUser();
            $usernames = [];
            while($row = mysqli_fetch_assoc($user)){
                if(strtolower($row['benutzername']) != 'admin'){
                    array_push($usernames, $row['benutzername']);
                }
            }
        ?>
        <form autocomplete="off" method="post" action="validate_feedback_statistics">
            <div class="div_input_user_search">
                <input id="input_user_search" type="text" name="username" placeholder="Benutzername">
            </div>
            <input class="button_search" name="submit_btn" type="submit" value="Anzeigen">
        </form>
        <form action="validate_feedback_statistics" method="post">
            <input class="button_zurück" type="submit" name="submit_btn" value="Zurück">
        </form>
    </div>
</div>

<script>
    var usernames = <?php echo json_encode($usernames)?>;
    autocomplete(document.getElementById("input_user_search"), usernames);

    function autocomplete(inp, arr) {
        var currentFocus;
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }
</script>