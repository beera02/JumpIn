<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <p class="p_form_title">
            Steckbriefkategorie zum bearbeiten auswählen
        </p>
        <table>
            <tr>
                <th>ID</th>
                <th>Steckbriefkategoriename</th>
                <th>Obligation</th>
                <th>Einzeiler</th>
                <th></th>
            </tr>
            <?php
                $allcategories = getAllCharacteristicsCategories();
                while($row = mysqli_fetch_assoc($allcategories)){
                    echo '
                        <tr>
                            <form action="steckbrief_edit" method="post">
                                <th>
                                    '.$row['id_steckbriefkategorie'].'
                                </th>
                                <th>
                                    '.$row['name'].'
                                </th>
                                <th>
                                    '.getJaNein($row['obligation']).'
                                </th>
                                <th>
                                    '.getJaNein($row['einzeiler']).'
                                </th>
                                <th>
                                    <input type="hidden" name="id_steckbriefkategorie" value="'.$row['id_steckbriefkategorie'].'"/>
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