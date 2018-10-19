<div class="div_main">
    <?php
        echo '<p id="p_stack">'.$_SESSION['stack'].'</p>';
    ?>
    <div class="div_form">
        <form action="validate_aktivitaetblock_add" method="post">
            <p class="p_form_title">
                Neuer Aktivitätsblock erstellen
            </p>
            <p class="p_form">Aktivitätsblockname</p>
            <input class="forms_textfield" type="text" name="name"/>
		    <br>
		    <p class="p_form">Aktivitätsart</p>
		    <select class="forms_dropdown" name="aktivitaetsart">
                <option value="null">-</option>
                <?php
                    $allarts = getAllArts();
                    while($row = mysqli_fetch_assoc($allarts)){
                        if($row['einschreiben'] == "1"){
                            echo '
                                <option value="'.$row['name'].'">'.$row['name'].'</option>
                            ';
                        }
                    }
                ?>
            </select>
            <br>
            <p class="p_form">Aufschaltzeit zum einschreiben</p>
            <input class="forms_date" type="date" name="writeindate"/>
            <input class="forms_time" type="time" name="writeintime"/>
            <br>
            <input class="button_weiter" type="submit" name="submit_btn" value="Erstellen"/>
            <input class="button_zurück" type="submit" name="submit_btn" value="Zurück"/>
        </form>
    </div>
</div>