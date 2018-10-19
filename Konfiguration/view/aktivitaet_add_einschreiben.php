<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <form action="validate_aktivitaet_add_einschreiben" method="post">
            <p class="p_form_title">
                Weitere Informationen für das Einschreiben
            </p>
            <p class="p_form">Aktivitätsblock</p>
            <select class="forms_dropdown" name="aktivitaetblock">
                <option value="null">-</option>
                <?php
                    $allarts = getAllActivityEntities();
                    var_dump($allarts);
                    while($row = mysqli_fetch_assoc($allarts)){
                        if(getArtIDByName($_SESSION['aktivitaetsart']) == $row['art_id']){
                            echo '
                                <option value="'.$row['name'].'">'.$row['name'].'</option>
                            ';
                        }
                    }
                ?>
            </select>
            <p class="p_form">Anzahl Teilnehmer</p>
            <input class="forms_textfield" type="text" name="anzahlteilnehmer"/>
		    <br>
            <input class="button_weiter" type="submit" name="submit_btn" value="Weiter"/>
        </form>
    </div>
</div>