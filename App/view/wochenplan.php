<?php
    global $faktor;
    global $nextcount;
    $faktor = 0;
    $nextcount = TRUE;
    $activitybefore = NULL;
    $margintopnow = 100;
    $margintopnext = 10;
    $orientation = 0;
    $next = FALSE;
    $datenow = date('Y-m-d H:i:s');

    $userid = getUserIDByUsername($_SESSION['benutzer_app']);
    $activities = getActivityByUserID($userid);
    $activityarray = mysqli_fetch_array($activities);
    while($row1 = mysqli_fetch_assoc($activities)){
        $height = calculateHeight($row1['startzeit'], $row1['endzeit'], $orientation);
        $cssheight = 'height: '.$height.'px;';

        if(strtotime(date("Y-m-d", strtotime($datenow))) != strtotime(date("Y-m-d", strtotime($row1['startzeit'])))){
            $cssday = 'color: grey;';
        }
        else if(date("Y-m-d", strtotime($datenow)) == date("Y-m-d", strtotime($row1['startzeit']))){
            $cssday = 'color: #584125;';
        }

        if($next == TRUE){
            $margintop = $margintopnext; 
            $margintopnext = 10;
        }
        else{
            $margintop = 10;
            $width = 'calc(100% - 30px)';
        }

        $nextactivity = getNextActivity($row1['startzeit'], $row1['id_aktivitaet']);
        if($nextactivity != NULL){
            if(strtotime($row1['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
                if($activitybefore != NULL){
                    if(strtotime($activitybefore['endzeit']) - strtotime($row1['startzeit']) > 0){
                        $orientation = 0;
                    }
                    else{
                        $orientation = 1;
                    }
                }
                else{
                    $orientation = 1;
                }
            }
            else{
                $orientation = 0;
            }
            if($orientation >= 1){
                $width = 'calc((100% - 30px) / ('.$orientation.' + 1) - 8px); float: left';
                $margintopnext += calculateHeight($row1['startzeit'], $nextactivity['startzeit'], $orientation);
                $next = TRUE;
            }
            else{
                $next = FALSE;
            }
        }

        if(!empty($row1['aktivitaetblock_id'])){
            $writtenin = getWrittenIn($userid, $row1['id_aktivitaet']);
            if($writtenin['aktivitaet_id'] == $row1['id_aktivitaet']){
                $margintopnow += calculateHeightNow($row1['startzeit'], $row1['endzeit'], $datenow, $orientation, $nextactivity);
                if($activitybefore != NULL){
                    if(getDay($activitybefore['startzeit']) == getDay($row1['startzeit'])){
                        echoActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssheight, $width, $margintop);
                    }
                    else{
                        echoDayActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssday, $cssheight, $width, $margintop);
                    }
                }
                else{
                    echoFirstActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssday, $cssheight, $width, $margintop);
                }
                $activitybefore = $row1;
            }
        }
        else{
            $margintopnow += calculateHeightNow($row1['startzeit'], $row1['endzeit'], $datenow, $orientation, $nextactivity);
            if($activitybefore != NULL){
                if(getDay($activitybefore['startzeit']) == getDay($row1['startzeit'])){
                    echoActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssheight, $width, $margintop);
                }
                else{
                    echoDayActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssday, $cssheight, $width, $margintop);
                }
            }
            else{
                echoFirstActivity($row1['startzeit'], $row1['endzeit'], $row1['id_aktivitaet'], $row1['aktivitaetsname'], $cssday, $cssheight, $width, $margintop);
            }
            $activitybefore = $row1;
        }
    }
    echo '
        <div class="nowline" style="top: '.$margintopnow.'px;"></div>
        <div class="nowpoint" style="top: '.$margintopnow.'px;"></div>
    ';

    function echoFirstActivity($starttime, $endtime, $activityid, $activityname, $cssday, $cssheight, $width, $margintop){
        echo '
            <div class="div_wochenplan_day">
                <div class="div_wochenplan_day_left" style="'.$cssday.'">
                    <p class="p_wochenplan_day_title">
                        '.getDay($starttime).'
                    </p>
                    <p class="p_wochenplan_day_undertitle">
                        '.getDateString($starttime).'
                    </p>
                </div>
                <div class="div_wochenplan_day_right">
                    <form action="wochenplan_view" method="post">
                        <button class="button_wochenplan" style="'.$cssheight.' width: '.$width.'; margin-top: '.$margintop.'px ;">
                            <div class="div_wochenplan_aktivitaet">
                                <p class="p_wochenplan_aktivitaet_title">
                                    '.$activityname.'
                                </p>
                                <p class="p_wochenplan_aktivitaet_time">
                                    '.getHours($starttime).' - '.getHours($endtime).'
                                </p>
                            </div>
                        </button>
                        <input type="hidden" name="id" value="'.$activityid.'">
                    </form>
        ';
    }

    function echoActivity($starttime, $endtime, $activityid, $activityname, $cssheight, $width, $margintop){
        echo '
            <form action="wochenplan_view" method="post">
                <button class="button_wochenplan" style="'.$cssheight.' width: '.$width.'; margin-top: '.$margintop.'px ;">
                    <div class="div_wochenplan_aktivitaet">
                        <p class="p_wochenplan_aktivitaet_title">
                            '.$activityname.'
                        </p>
                        <p class="p_wochenplan_aktivitaet_time">
                            '.getHours($starttime).' - '.getHours($endtime).'
                        </p>
                    </div>
                </button>
                <input type="hidden" name="id" value="'.$activityid.'">
            </form>
        ';
    }

    function echoDayActivity($starttime, $endtime, $activityid, $activityname, $cssday, $cssheight, $width, $margintop){
        echo '
                </div>
            </div>  
            <div class="div_wochenplan_day">
                <div class="div_wochenplan_day_left" style="'.$cssday.'">
                    <p class="p_wochenplan_day_title">
                        '.getDay($starttime).'
                    </p>
                    <p class="p_wochenplan_day_undertitle">
                        '.getDateString($starttime).'
                    </p>
                </div>
                <div class="div_wochenplan_day_right">
                    <form action="wochenplan_view" method="post">
                        <button class="button_wochenplan" style="'.$cssheight.' width: '.$width.'; margin-top: '.$margintop.'px ;">
                            <div class="div_wochenplan_aktivitaet">
                                <p class="p_wochenplan_aktivitaet_title">
                                    '.$activityname.'
                                </p>
                                <p class="p_wochenplan_aktivitaet_time">
                                    '.getHours($starttime).' - '.getHours($endtime).'
                                </p>
                            </div>
                        </button>
                        <input type="hidden" name="id" value="'.$activityid.'">
                    </form>
        ';
    }

    function getDay($date){
        $numericday = date("w", strtotime($date));

        if($numericday == 1){
            return 'Mon';
        }
        else if($numericday == 2){
            return 'Die';
        }
        else if($numericday == 3){
            return 'Mit';
        }
        else if($numericday == 4){
            return 'Don';
        }
        else if($numericday == 5){
            return 'Fre';
        }
        else if($numericday == 6){
            return 'Sam';
        }
        else{
            return 'Son';
        }
    }

    function getDateString($date){
        $day = date("j", strtotime($date));
        $numericmonth = date("n", strtotime($date));
        $month = "";

        if($numericmonth == 1){
            $month = 'Jan';
        }
        else if($numericmonth == 2){
            $month = 'Feb';
        }
        else if($numericmonth == 3){
            $month = 'Mär';
        }
        else if($numericmonth == 4){
            $month = 'Apr';
        }
        else if($numericmonth == 5){
            $month = 'Mai';
        }
        else if($numericmonth == 6){
            $month = 'Jun';
        }
        else if($numericmonth == 7){
            $month = 'Jul';
        }
        else if($numericmonth == 8){
            $month = 'Aug';
        }
        else if($numericmonth == 9){
            $month = 'Sep';
        }
        else if($numericmonth == 10){
            $month = 'Okt';
        }
        else if($numericmonth == 11){
            $month = 'Nov';
        }
        else{
            $month = 'Dez';
        }

        return ''.$day.'. '.$month.'';
    }

    function getHours($time){
        return date("H:i", strtotime($time));
    }

    function calculateHeight($starttime, $endtime, $orientation){
        $minutes = round((strtotime($endtime) - strtotime($starttime)) / 60,0);
        $height = $minutes * 2;
        return shortenHeight($height, $orientation);
    }

    function shortenHeight($height, $orientation){
        global $faktor;
        if($faktor > 0){
            return $height / $faktor;
        }
        else if($height > 360){
            if($orientation >= 1){
                $faktor = 3.5;
            }
            return $height / 3.5;
        }
        else if($height > 240){
            if($orientation >= 1){
                $faktor = 3;
            }
            return $height / 3;
        }
        else if($height > 120){
            if($orientation >= 1){
                $faktor = 2.5;
            }
            return $height / 2.5;
        }
        else{
            if($orientation >= 1){
                $faktor = 1.5;
            }            
            return $height / 1.5;
        }
    }

    function calculateHeightNow($starttime, $endtime, $datenow, $orientation, $nextactivity){
        global $nextcount;
        global $faktor;
        if($orientation >= 1){
            if($nextcount == TRUE){
                $nextcount = FALSE;
                if(strtotime($endtime) - strtotime($nextactivity['endzeit']) > 0){
                    if(strtotime($endtime) - strtotime($datenow) > 0){
                        if(strtotime($starttime) - strtotime($datenow) < 0){
                            return calculateHeight($starttime, $datenow, $orientation) + 10;
                        }
                    }
                    else if(strtotime($datenow) - strtotime($endtime) > 0){
                        return calculateHeight($starttime, $endtime, $orientation) + 20;
                    }
                }
                else{
                    if(strtotime($nextactivity['endzeit']) - strtotime($datenow) > 0){
                        if(strtotime($starttime) - strtotime($datenow) < 0){
                            return calculateHeight($starttime, $datenow, $orientation) + 10;
                        }
                    }
                    else if(strtotime($datenow) - strtotime($nextactivity['endzeit']) > 0){
                        return calculateHeight($starttime, $nextactivity['endzeit'], $orientation) + 20;
                    }
                }
            }
            else{
                $nextcount = TRUE;
                return 0;
            }
        }
        else{
            if($nextcount == TRUE){
                $nextcount = TRUE;
                if(strtotime($endtime) - strtotime($datenow) > 0){
                    if(strtotime($starttime) - strtotime($datenow) < 0){
                        return calculateHeight($starttime, $datenow, $orientation) + 10;
                    }
                }
                else if(strtotime($datenow) - strtotime($endtime) > 0){
                    return calculateHeight($starttime, $endtime, $orientation) + 20;
                }
            }
            else{
                $nextcount = TRUE;
                return 0;
            }
        }
        $faktor = 0;
    }
?>