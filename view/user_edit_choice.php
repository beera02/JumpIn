<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Benutzer zum bearbeiten auswählen
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
                        Benutzername
                    </p>
                </div>
                <div id="div_select_edit_column_3">
                    <p>
                        Vorname
                    </p>
                </div>
                <div id="div_select_edit_column_4">
                    <p>
                        Nachname
                    </p>
                </div>
                <div id="div_select_edit_column_5"></div>
            </div>
            <?php
                $allusers = getAllUser();
                while($row = mysqli_fetch_assoc($allusers)){
                    echo '
                    <form action="user_edit" method="post">
                        <div id="div_select_edit_line">
                            <div id="div_select_edit_column_1">
                                <p>
                                    '.$row['id_benutzer'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_2">
                                <p>
                                    '.$row['benutzername'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_3">
                                <p>
                                    '.$row['vorname'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_4">
                                <p>
                                    '.$row['name'].'
                                </p>
                            </div>
                            <div id="div_select_edit_column_5">
                                <input type="hidden" name="id_benutzer" value="'.$row['id_benutzer'].'"/>
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