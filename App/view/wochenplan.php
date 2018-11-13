<?php
    global $faktor;
    $faktor = 0;
    $orientation = 0;
    $datenow = date('Y-m-d H:i:s');

    $userid = getUserIDByUsername($_SESSION['benutzer_app']);
    $activities = getActivityByUserID($userid);
    while($activity = mysqli_fetch_assoc($activities)){
        if(getValidActivity($activity, $userid)){
            $margintopnowpointer = 105;
            $margintopcontainer = 10;

            $nextactivity = getNextValidActivity($activity, $userid);
            $activitybefore = getBeforeValidActivity($activity, $userid);

            $schnittmenge = getSchnittmenge($activity, $activitybefore, $nextactivity);
            $orientation = getOrientation($activity, $userid); 

            $cssday = colorDay($activity, $datenow);
            $containerwidth = getContainerWidth($activity, $nextactivity, $schnittmenge);
            $containerheight = getContainerHeight($activity, $schnittmenge); 
            $margintopnowpointer += getMarginTopNowPointer($activity, $nextactivity, $activitybefore);
            $margintopcontainer += getMarginTopContainer();

            getValidContainer($activity, $activitybefore, $cssday, $containerheight, $containerwidth, $margintopcontainer);  
        }
    }
    echo '
        <div class="nowline" style="'.$margintopnowpointer.'"></div>
        <div class="nowpoint" style="'.$margintopnowpointer.'"></div>
    ';

    function getMarginTopNowPointer($activity, $nextactivity, $activitybefore){
        $height = 0;
        if(strtotime($activity['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
            $height = calculateHeight($activity['startzeit'], $nextactivity['startzeit']) + 20;
        }
        else if(strtotime($activitybefore['endzeit']) - strtotime($activity['startzeit']) > 0){
            $height = calculateHeight($activity['startzeit'], $activity['endzeit']) + 10;
        }
        else{
            $height = calculateHeight($activity['startzeit'], $activity['endzeit']) + 20;
        }
    }

    function getMarginTopContainer(){
        global $faktor;

        $faktor = 0;
    }

    function calculateHeight($starttime, $endtime){
        $minutes = round((strtotime($endtime) - strtotime($starttime)) / 60,0);
        $height = $minutes * 2;
        return shortenHeight($height);
    }

    function shortenHeight($height){
        global $faktor;
        if($faktor > 0){
            return $height / $faktor;
        }
        else{
            if($height < 60){
                $faktor = 0.6;
            }
            else if($height < 120){
                $faktor = 1;
            }
            else if($height < 360){
                $faktor = 1.5;
            }
            else if($height < 600){
                $faktor = 2;
            }
            else{
                $faktor = 2.5;
            }
            return $height / $faktor;
        }
    }

    function getOrientation($activity, $userid){
        $orientation = 0;
        $activitiesbefore = getActivitiesBefore($activity['startzeit'], $activity['id_aktivitaet'], $userid);
        if(!empty($activitiesbefore)){
            while($row2 = mysqli_fetch_assoc($activitiesbefore)){
                $nextactivity = getNextValidActivity($row2, $userid);
                $activitybefore = getBeforeValidActivity($row2, $userid);
                if(!empty($activitybefore)){
                    if(!empty($nextactivity)){
                        if(strtotime($row2['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
                            $orientation++;
                        }
                        else if(strtotime($activitybefore['endzeit']) - strtotime($row2['startzeit']) > 0){
                            $orientation++;
                        }
                        else{
                            $orientation = 0;
                        }
                    }
                    else{
                        if(strtotime($activitybefore['endzeit']) - strtotime($row2['startzeit']) > 0){
                            $orientation++;
                        }
                        else{
                            $orientation = 0;
                        }
                    }
                }
                else if(!empty($nextactivity)){
                    if(strtotime($row2['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
                        $orientation++;
                    }
                    else{
                        $orientation = 0;
                    }
                }
                else{
                    $orientation = 0;
                }
            }
        }
        return $orientation % 2;
    }

    function getNextValidActivity($activity, $userid){
        $return = FALSE;
        while($return != TRUE){
            if(!empty($activity)){
                $nextactivity = getNextActivity($activity['startzeit'], $activity['id_aktivitaet'], $userid);
                if($nextactivity['aktivitaetblock_id'] == NULL){
                    $validactivity = $nextactivity;
                    $return = TRUE;
                }
                else{
                    $nextwrittenin = getWrittenIn($userid, $nextactivity['id_aktivitaet']);
                    if($nextwrittenin['aktivitaet_id'] == $nextactivity['id_aktivitaet']){
                        $validactivity = $nextactivity;
                        $return = TRUE;
                    }
                    else{
                        getNextValidActivity($nextactivity, $userid);
                        break;
                    }
                }
            }
            else{
                $validactivity = NULL;
                $return = TRUE;
            }
        }
        return $validactivity;
    }

    function getBeforeValidActivity($activity, $userid){
        $return = FALSE;
        while($return != TRUE){
            if(!empty($activity)){
                $activitybefore = getActivityBefore($activity['startzeit'], $activity['id_aktivitaet'], $userid);
                if($activitybefore['aktivitaetblock_id'] == NULL){
                    $validactivity = $activitybefore;
                    $return = TRUE;
                }
                else{
                    $beforewrittenin = getWrittenIn($userid, $activitybefore['id_aktivitaet']);
                    if($beforewrittenin['aktivitaet_id'] == $activitybefore['id_aktivitaet']){
                        $validactivity = $activitybefore;
                        $return = TRUE;
                    }
                    else{
                        getBeforeValidActivity($nextactivity, $userid);
                        break;
                    }
                }
            }
            else{
                $validactivity = NULL;
                $return = TRUE;
            }
        }
        return $validactivity;
    }

    function colorDay($activity, $datenow){
        if(strtotime(date("Y-m-d", strtotime($datenow))) != strtotime(date("Y-m-d", strtotime($activity['startzeit'])))){
            return 'color: grey;';
        }
        else if(date("Y-m-d", strtotime($datenow)) == date("Y-m-d", strtotime($activity['startzeit']))){
            return 'color: #584125;';
        }
    }

    function getValidActivity($activity, $userid){
        if($activity['aktivitaetblock_id'] != NULL){
            $writein = TRUE;
        }
        else{
            $writein = FALSE;
        }
        if($writein == TRUE){
            $writtenin = getWrittenIn($userid, $activity['id_aktivitaet']);
            if($writtenin['aktivitaet_id'] == $activity['id_aktivitaet']){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else if($writein == FALSE){
            return TRUE;
        }
    }

    function getContainerHeight($activity, $schnittmenge){
        $height = calculateHeight($activity['startzeit'], $activity['endzeit'], $schnittmenge);
        return 'height: '.$height.'px ;';
    }

    function getSchnittmenge($activity, $activitybefore, $nextactivity){
        if(strtotime($activity['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
            return TRUE;
        }
        else if(strtotime($activitybefore['endzeit']) - strtotime($activity['startzeit']) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function getContainerFloat($activity, $nextactivity){
        if(strtotime($activity['endzeit']) - strtotime($nextactivity['startzeit']) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function getContainerWidth($activity, $nextactivity, $schnittmenge){
        $width = '';
        if($schnittmenge){
            $width = 'width: calc(((100% - 30px) / 2) - 8px);';
        }
        else{
            $width = 'width: calc(100% - 30px);';
        }
        if(getContainerFloat($activity, $nextactivity)){
            $width .= 'float: left;';
        }
        return $width;
    }

    function getValidContainer($activity, $activitybefore, $cssday, $containerheight, $containerwidth, $margintopcontainer){
        if($activitybefore != NULL){
            if(getDay($activitybefore['startzeit']) == getDay($activity['startzeit'])){
                echoActivity($activity['startzeit'], $activity['endzeit'], $activity['id_aktivitaet'], $activity['aktivitaetsname'], $containerheight, $containerwidth, $margintopcontainer);
            }
            else{
                echoCloseDay();
                echoStartDay($activity['startzeit'], $cssday);
                echoActivity($activity['startzeit'], $activity['endzeit'], $activity['id_aktivitaet'], $activity['aktivitaetnsame'], $containerheight, $containerwidth, $margintopcontainer);
            }
        }
        else{
            echoStartDay($activity['startzeit'], $cssday);
            echoActivity($activity['startzeit'], $activity['endzeit'], $activity['id_aktivitaet'], $activity['aktivitaetsname'], $containerheight, $containerwidth, $margintopcontainer);
        }
    }

    function echoStartDay($starttime, $cssday){
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
        ';
    }

    function echoActivity($starttime, $endtime, $activityid, $activityname, $containerheight, $containerwidth, $margintopcontainer){
        echo '
            <form action="wochenplan_view" method="post">
                <button class="button_wochenplan" style="'.$containerheight.' '.$containerwidth.' '.$margintopcontainer.'">
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

    function echoCloseDay(){
        echo '
                </div>
            </div>  
        ';
    }
?>