<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Benutzer zum bearbeiten auswählen
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Benutzername</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th></th>
            </tr>
            <?php
                $allusers = getAllUser();
                while($row = mysqli_fetch_assoc($allusers)){
                    echo '
                        <tr>
                            <form action="user_edit" method="post">
                                <th>
                                    '.$row['id_benutzer'].'
                                </th>
                                <th>
                                    '.$row['benutzername'].'
                                </th>
                                <th>
                                    '.$row['vorname'].'
                                </th>
                                <th>
                                    '.$row['name'].'
                                </th>
                                <th>
                                    <input type="hidden" name="id_benutzer" value="'.$row['id_benutzer'].'"/>
                                    <input class="button_weiter_table" type="submit" name="submit_btn" value="Bearbeiten"/>
                                </th>
                            </form>  
                        </tr>  
                    ';
                }
            ?>
        </table>
    </div>
</div>