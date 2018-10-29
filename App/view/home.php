<?php
    if($_SESSION['benutzer_app']){
        $arts = getAllArts();
        $i = 1;
        while($row1 = mysqli_fetch_assoc($arts)){
            if($row1['einschreiben'] == "1"){
                $activityentities = getActivityentitiesByArtID($row1['id_art']);
                while($row2 = mysqli_fetch_assoc($activityentities)){
                    if(strtotime(date("Y-m-d H:i:s")) - strtotime($row2['einschreibezeit']) >= 0){
                        $activities = getActivityByActivityentityID($row2['id_aktivitaetblock']);
                        while($row3 = mysqli_fetch_assoc($activities)){
                            if(strtotime($row3['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0){
                                echo '
                                    <a class="a_section" href="">
                                        <section class="section section'.$row1['name'].'" id="section'.$i.'">
                                            <p class="p_section">'.$row1['name'].'</p>
                                        </section>
                                    </a>
                                ';
                                $i++;
                                break 2;
                            }
                        }
                    }
                }
            }
        }
        echo '
            <a class="a_section" href="">
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
