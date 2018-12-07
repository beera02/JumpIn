<?php
    global $faktor;
    $faktor;

    $datenow = date('Y-m-d H:i:s');

    $userid = getUserIDByUsername($_SESSION['benutzer_app']);
    $daylist = setDayList($userid);
    printOutArray($daylist);
    setValues($daylist);

    echo '
        <div class="nowline" style="'.$margintopnowpointer.'"></div>
        <div class="nowpoint" style="'.$margintopnowpointer.'"></div>
    ';

    function setValues($daylist){
        foreach($daylist as $day){
            foreach($day as $column){
                foreach($column as $activity){
                    if(count($day) == 1){
                        $activity['width'] = "width: calc(100% - 30px);";
                    }
                    else{
                        $daylist[array_search($day, $daylist)][array_search($column, $day)][array_search($column, $day)];             
                    }
                    if(array_search($column, $day) == 1){
                        $activity['width'] .= "float: left;";
                        $activity['left'] = "margin-left: 10px;";
                    }
                    else{
                        $activity['left'] = "margin-left: calc((100% / ".array_search($column, $day).") + 10px);";
                    }
                }
            }
        }
    }

    function setDayList($userid){
        global $faktor;
        $activities = getActivityByUserID($userid);
        $activitybefore;
        $daylist = array();
        $number = 1;
        while($activity = mysqli_fetch_assoc($activities)){
            if(isValidActivity($activity, $userid)){
                if($activitybefore != NULL){
                    if(getDay($activity['startzeit']) != getDay($activitybefore['startzeit'])){
                        $day = array();
                        $column = array();
                        $activitypush = setActivityList($activity, $number);
                        array_push($column, $activitypush);
                        array_push($day, $column);
                        array_push($daylist, $day);
                    }
                    else{
                        $day = $daylist[count($daylist) - 1];
                        $columns = count($day);
                        $nextcolumn = getNextColumn($activity, $day, $columns, 1);
                        if($nextcolumn >= $columns){
                            $column = array();
                            $activitypush = setActivityList($activity, $number);
                            array_push($column, $activitypush);
                            array_push($daylist[count($daylist) - 1], $column);
                        }
                        else{
                            array_push($daylist[count($daylist) - 1][$nextcolumn], setActivityList($activity, $number));
                        }
                    }
                }
                else{
                    $day = array();
                    $column = array();
                    $activitypush = setActivityList($activity, $number);
                    array_push($column, $activitypush);
                    array_push($day, $column);
                    array_push($daylist, $day);
                }
                $activitybefore = $activity;
                $number++;
                $faktor = 0;
            }
        }
        return $daylist;
    }

    function getNextColumn($activity, $day, $columns, $columnsless){
        if(strtotime($activity['startzeit']) - strtotime($day[$columns - $columnsless][count($day[$columns - $columnsless]) - 1]['endzeit']) < 0){
            if($columns > $columnsless){
                return getNextColumn($activity, $day, $columns, $columnsless + 1);
            }
            else{
                return $columns + 1;
            }
        }
        else{
            $returncolumns = $columns - 1;
            for ($i = 1; $i <= $columns; $i++){
                if(strtotime($activity['startzeit']) - strtotime($day[$columns - $i][count($day[$columns - $i]) - 1]['endzeit']) >= 0){
                    $returncolumns = $columns - $i;
                }
            }
            return $returncolumns;
        }
    }

    function setActivityList($activity, $number){
        return array(
            "id_aktivitaet" => $activity['id_aktivitaet'],
            "aktivitaetsname" => $activity['aktivitaetsname'],
            "startzeit" => $activity['startzeit'],
            "endzeit" => $activity['endzeit'],
            "height" => calculateHeight($activity['startzeit'], $activity['endzeit']),
            "width" => "",
            "top" => "",
            "left" => "",
            "number" => $number,
        );
    }

    function printOutArray($daylist){
        foreach($daylist as $day){
            echo 'Tag '.array_search($day, $daylist).":<br>";
            foreach($day as $column){
                echo " x x Spalte ".array_search($column, $day).":<br>";
                foreach($column as $activity){
                    echo " x x x x x x Aktivität ".array_search($activity, $column).":<br>";
                    echo "x x x x x x x x ID: ".$activity['id_aktivitaet'].":<br>";
                    echo "x x x x x x x x Name: ".$activity['aktivitaetsname'].":<br>";
                    echo "x x x x x x x x Startzeit: ".$activity['startzeit'].":<br>";
                    echo "x x x x x x x x Endzeit: ".$activity['endzeit'].":<br>";
                    echo "x x x x x x x x Höhe: ".$activity['height'].":<br>";
                    echo "x x x x x x x x Breite: ".$activity['width'].":<br>";
                    echo "x x x x x x x x Margin-Top: ".$activity['top'].":<br>";
                    echo "x x x x x x x x Margin-Left: ".$activity['left'].":<br>";
                    echo "x x x x x x x x Nummer: ".$activity['number'].":<br>";
                }
            }
        }
    }

    function isValidActivity($activity, $userid){
        if($activity['aktivitaetblock_id'] != NULL){
            $writtenin = getWrittenIn($userid, $activity['id_aktivitaet']);
            if($writtenin['aktivitaet_id'] == $activity['id_aktivitaet']){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            return TRUE;
        }
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

    function colorDay($activity, $datenow){
        if(strtotime(date("Y-m-d", strtotime($datenow))) != strtotime(date("Y-m-d", strtotime($activity['startzeit'])))){
            return 'color: grey;';
        }
        else if(date("Y-m-d", strtotime($datenow)) == date("Y-m-d", strtotime($activity['startzeit']))){
            return 'color: #584125;';
        }
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