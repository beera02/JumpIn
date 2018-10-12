<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Aktivität zum bearbeiten auswählen
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Aktivitätsname</th>
                <th>Aktivitätsart</th>
                <th>Einschreiben</th>
                <th>Startzeit</th>
                <th></th>
            </tr>
            <?php
                $allactivities = getAllActivitiesOrdered();
                while($row = mysqli_fetch_assoc($allactivities)){
                    echo '
                        <tr>
                            <form action="validate_aktivitaet_edit_choice" method="post">
                                <th>
                                    '.$row['id_aktivitaet'].'
                                </th>
                                <th>
                                    '.$row['aktivitaetsname'].'
                                </th>
                                <th>
                                    '.getArtNameByID($row['art_id']).'
                                </th>
                                <th>
                                    '.getJaNein($row['einschreiben']).'
                                </th>
                                <th>
                                    '.getDaysHours($row['startzeit']).'
                                </th>
                                <th>
                                    <input type="hidden" name="id_aktivitaet" value="'.$row['id_aktivitaet'].'"/>
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