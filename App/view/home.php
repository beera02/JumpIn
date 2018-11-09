<?php
    if($_SESSION['benutzer_app']){
        getWriteinPossebilities('home');
        echo '
            <a class="a_section" href="wochenplan">
                <section class="section sectionWochenplan" id="section'.$i.'">
                    <p class="p_section">Wochenplan</p>
                </section>
            </a>
        ';
        $i++;
        echo '
            <a class="a_section" href="steckbrief_choice">
                <section class="section sectionSteckbrief" id="section'.$i.'">
                    <p class="p_section">Steckbrief</p>
                </section>
            </a>
        ';
        $i++;
        echo '
            <a class="a_section" href="">
                <section class="section sectionFeedback" id="section'.$i.'">
                    <p class="p_section">Feedback</p>
                </section>
            </a>
        ';
        $i++;
        echo '
            <a class="a_section" href="notfall">
                <section class="section sectionNotfall" id="section'.$i.'">
                    <p class="p_section">Notfall</p>
                </section>
            </a>
        ';
        $i++;
    }
    else{
        $_SESSION['validfiles'] = array("home", "login", "validate_login");
    }
?>
