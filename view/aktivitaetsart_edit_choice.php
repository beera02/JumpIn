<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Aktivitaetsart zum bearbeiten auswählen
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Aktivitätsartname</th>
                <th></th>
            </tr>
            <?php
                $allarts = getAllArts();
                while($row = mysqli_fetch_assoc($allarts)){
                    echo '
                        <tr>
                            <form action="validate_aktivitaetsart_edit_choice" method="post">
                                <th>
                                    '.$row['id_art'].'
                                </th>
                                <th>
                                    '.$row['name'].'
                                </th>
                                <th>
                                    <input type="hidden" name="id_art" value="'.$row['id_art'].'"/>
                                    <input class="button_weiter_table" type="submit" name="submit_btn" value="Bearbeiten"/>
                                    <input class="button_delete" type="submit" name="submit_btn" value="Löschen"/>
                                </th>
                            </form>  
                        </tr>     
                    ';
                }
            ?>
        </table>
        <form action="stack" method="post">
            <input class="button_zurück_choice" type="submit" name="submit_btn" value="Zurück">
        </form>
    </div>
</div>