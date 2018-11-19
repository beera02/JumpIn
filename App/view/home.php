<?php
    if($_SESSION['benutzer_app']){
        getWriteinPossebilities('home');
        echo '
            <a class="a_section" href="wochenplan">
                <section class="section sectionWochenplan">
                    <p class="p_section">Wochenplan</p>
                </section>
            </a>
        ';
        echo '
            <a class="a_section" href="steckbrief_choice">
                <section class="section sectionSteckbrief">
                    <p class="p_section">Steckbrief</p>
                </section>
            </a>
        ';
        getFeedback('home');
        echo '
            <a class="a_section" href="notfall">
                <section class="section sectionNotfall">
                    <p class="p_section">Notfall</p>
                </section>
            </a>
        ';
    }
    else{
        $_SESSION['validfiles'] = array("home", "login", "validate_login");
    }
?>
