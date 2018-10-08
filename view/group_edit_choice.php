<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Gruppe zum bearbeiten auswählen
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
                        Gruppenname
                    </p>
                </div>
                <div id="div_select_edit_column_5"></div>
            </div>
            <?php
                $allgroups = getAllGroups();
                while($row = mysqli_fetch_assoc($allgroups)){
                    if($row['name'] == "admin"){
                        echo '
                        <form action="group_edit" method="post">
                            <div id="div_select_edit_line">
                                <div id="div_select_edit_column_1">
                                    <p>
                                        '.$row['id_gruppe'].'
                                    </p>
                                </div>
                                <div id="div_select_edit_column_2">
                                    <p>
                                        '.$row['name'].'
                                    </p>
                                </div>
                                <div id="div_select_edit_column_3">
                                    <input type="hidden" name="id_gruppe" value="'.$row['id_gruppe'].'"/>
                                    <input class="button_weiter" type="submit" name="submit_btn" value="Bearbeiten" disabled/>
                                </div>
                            </div>
                        </form>    
                        ';
                    }
                    else{
                        echo '
                        <form action="group_edit" method="post">
                            <div id="div_select_edit_line">
                                <div id="div_select_edit_column_1">
                                    <p>
                                        '.$row['id_gruppe'].'
                                    </p>
                                </div>
                                <div id="div_select_edit_column_2">
                                    <p>
                                        '.$row['name'].'
                                    </p>
                                </div>
                                <div id="div_select_edit_column_3">
                                    <input type="hidden" name="id_gruppe" value="'.$row['id_gruppe'].'"/>
                                    <input class="button_weiter" type="submit" name="submit_btn" value="Bearbeiten"/>
                                </div>
                            </div>
                        </form>    
                        ';
                    }
                }
            ?>
        </div>
    </div>
</div>