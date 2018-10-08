<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Aktivitaetsart zum bearbeiten auswählen
        </p>
        <div id="div_select_edit_container">
            <div id="div_select_edit_line_first">
                <div class="div_select_edit_column_1">
                    <p>
                        ID
                    </p>
                </div>
                <div id="div_select_edit_column_2">
                    <p>
                        Aktivitaetsartname
                    </p>
                </div>
                <div id="div_select_edit_column_5"></div>
            </div>
            <?php
                $allarts = getAllArts();
                while($row = mysqli_fetch_assoc($allarts)){
                    echo '
                    <form action="aktivitaetsart_edit" method="post">
                        <div id="div_select_edit_line">
                            <div id="div_select_edit_column_1">
                                <p>
                                    '.$row['id_art'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_2">
                                <p>
                                    '.$row['name'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_3">
                                <input type="hidden" name="id_art" value="'.$row['id_art'].'"/>
                                <input class="button_weiter" type="submit" name="submit_btn" value="Bearbeiten"/>
                            </div>
                        </div>
                    </form>    
                    ';
                }
            ?>
        </div>
    </div>
</div>