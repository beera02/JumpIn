<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Notfallkartenkategorie zum bearbeiten auswählen
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Notfallname</th>
                <th>Notfallinfo</th>
                <th></th>
            </tr>
            <?php
                $allcategories = getAllEmergencyCategories();
                while($row = mysqli_fetch_assoc($allcategories)){
                    echo '
                        <tr>
                            <form action="notfallkarte_edit" method="post">
                                <th>
                                    '.$row['id_notfallkategorie'].'
                                </th>
                                <th>
                                    '.$row['name'].'
                                </th>
                                <th>
                                    '.$row['info'].'
                                </th>
                                <th>
                                    <input type="hidden" name="id_notfallkategorie" value="'.$row['id_notfallkategorie'].'"/>
                                    <input class="button_weiter_table" type="submit" name="submit_btn" value="Bearbeiten"/>
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