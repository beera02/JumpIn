<?php
    class Activity{
        private $id_aktivitaet;
        private $aktivitaetsname;
        private $startzeit;
        private $endzeit;
        private $activityclass;
        private $height;
        private $width;
        private $left;
        private $top;
        private $column;
        private $number = 0;

        public function __construct($id_aktivitaet, $aktivitaetsname, $startzeit, $endzeit, $activityclass, $column, $number) {
            $this->id_aktivitaet = $id_aktivitaet;
            $this->aktivitaetsname = $aktivitaetsname;
            $this->startzeit = $startzeit;
            $this->endzeit = $endzeit;
            $this->activityclass = $activityclass;
            $this->column = $column;
            $this->number = $number;
        }

        public function getAktivitaetid() {
            return $this->id_aktivitaet;
        }
        public function getAktivitaetsname() {
            return $this->aktivitaetsname;
        }
        public function getStartzeit() {
            return $this->startzeit;
        }
        public function getEndzeit() {
            return $this->endzeit;
        }
        public function getActivityClass() {
            return $this->activityclass;
        }
        public function getHeight() {
            return $this->height;
        }
        public function getWidth() {
            return $this->width;
        }
        public function getLeft() {
            return $this->left;
        }
        public function getTop() {
            return $this->top;
        }
        public function getColumn() {
            return $this->column;
        }
        public function getNumber() {
            return $this->number;
        }

        public function setHeight($height){
            $this->height = $height;
        }
        public function setWidth($width){
            $this->width = $width;
        }
        public function setLeft($left){
            $this->left = $left;
        }
        public function setTop($top){
            $this->top = $top;
        }
    }
    global $daylistcolumns, $daylisttime, $nowline, $colors, $activityclasses;
    $colors = array("f49e00", "00545e", "a5c400", "3d6f1a", "a51728", "00b5d1", "A895E2");
    $nowline = false;
    $daylistcolumns = array();
    $daylisttime = array();
    $activityclasses = array();
    buildWeekschedule();

    function buildWeekschedule(){
        $userid = getUserIDByUsername($_SESSION['benutzer_app']);
        setDayList($userid);
        setValuesDayList();
        printWeekschedule();
    }

    function printWeekschedule(){
        global $daylisttime;
        global $nowline;
        foreach($daylisttime as $day){
            if(!$nowline){
                getNowLine($daylisttime, $day);
            }
            echoDay($day[0]->getStartzeit(), colorDay($day[0], date('Y-m-d H:i:s')));
            foreach($day as $activity){
                if($activity->getEndzeit() == getBiggestEndHeight($day)){
                    echoDivBlocker($activity->getHeight(), $activity->getTop());
                }
                echoActivity($activity->getStartzeit(), $activity->getEndzeit(), $activity->getAktivitaetid(), $activity->getAktivitaetsname(), $activity->getHeight(), $activity->getWidth(), $activity->getLeft(), $activity->getTop(), $activity->getActivityClass());
            }  
            echoCloseDay();
        }
    }

    function getNowLine($daylisttime, $day){
        global $nowline;
        $now = date("Y-m-d H:i:s");
        end($daylisttime[array_search($day, $daylisttime)]);
        if(strtotime($now) < strtotime($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit())){
            echoNowLine(5);
            $nowline = true;
        }
        else if(strtotime($now)> strtotime($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit()) && strtotime($now)< strtotime($daylisttime[array_search($day, $daylisttime)][key($daylisttime[array_search($day, $daylisttime)])]->getEndzeit())){
            $diffrenceabsolute = calculateHeight($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit(), $now);
            $gap = getGapNowPointer($now, $day);
            echoNowLine($diffrenceabsolute - ($gap + 30));
            $nowline = true;
        }
        else{
            $lastElement = end($daylisttime);
            if($day == $lastElement){
                $diffrenceabsolute = calculateHeight($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit(), $now);
                $gap = getGapNowPointer($now, $day);
                echoNowLine(($diffrenceabsolute - $gap) + 5);
                $nowline = true;
            }
        }
    }

    function getGapNowPointer($nowtime, $day){
        global $daylistcolumns, $daylisttime;
        $gap = 0;
        $i = 10;
        foreach($daylistcolumns[array_search($day, $daylisttime)][0] as $activitytwo){
            if(strtotime($nowtime) >= strtotime($activitytwo->getStartzeit())){
                $gapshort = calculateHeight(getBiggestEnd($day, $activitytwo), $activitytwo->getStartzeit());
                if($gapshort > 0){
                    $gap += ($gapshort - $i);
                }
            }
            $i += 10;
        }
        return $gap;
    }

    function echoDivBlocker($height, $top){
        $parts = explode(" ",$top);
        $pixel = explode("p", $parts[1]);
        $newtop = intval($pixel[0]) + 20;
        echo '
            <div style="'.$height.' margin-top:'.$newtop.'px; visibility: hidden;"></div>
        ';
    }

    function echoNowLine($margintopnowpointer){
        $margintopnowpoint = $margintopnowpointer - 7.5;
        echo '
            <div class="nowline" style="margin-top: '.$margintopnowpointer.'px;"></div>
            <div class="nowpoint" style="margin-top: '.$margintopnowpoint.'px;"></div>
        ';
    }

    function echoDay($starttime, $cssday){
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
        ';
    }

    function echoActivity($starttime, $endtime, $activityid, $activityname, $containerheight, $containerwidth, $left, $top, $backgoundcolor){
        global $colors, $activityclasses;
        echo '
            <form action="wochenplan_view" method="post">
                <button class="button_wochenplan" style="'.$containerheight.' '.$containerwidth.' '.$left.' '.$top.' background-color: #'.$colors[array_search($backgoundcolor, $activityclasses)].';">
                    <div class="div_wochenplan_aktivitaet">
                        <p class="p_wochenplan_aktivitaet_title">
                            '.$activityname.'
                        </p>
        ';
        if(strtotime($endtime) - strtotime($starttime) > 1800){
            echo '
                <p class="p_wochenplan_aktivitaet_time">
                    '.getHours($starttime).'- '.getHours($endtime).'
                </p>
            ';
        }
        echo '
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

    function setDayList($userid){
        global $daylistcolumns, $daylisttime, $activityclasses;
        $activities = getActivityByUserID($userid);
        $activitybefore;
        $number = 1;
        while($activity = mysqli_fetch_assoc($activities)){
            if(isValidActivity($activity, $userid)){
                if($activitybefore != NULL){
                    if(getDay($activity['startzeit']) != getDay($activitybefore['startzeit'])){
                        $daytime = array();
                        $daycolumns = array();
                        $column = array();
                        $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], $activity['art_id'], 0, $number);
                        array_push($daytime, $activityobject);
                        array_push($daylisttime, $daytime);
                        array_push($column, $activityobject);
                        array_push($daycolumns, $column);
                        array_push($daylistcolumns, $daycolumns);
                    }
                    else{
                        $daycolumns = $daylistcolumns[count($daylistcolumns) - 1];
                        $columns = count($daycolumns);
                        $nextcolumn = getNextColumn($activity, $daycolumns, $columns, 1);
                        $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], $activity['art_id'], $nextcolumn, $number);
                        array_push($daylisttime[count($daylisttime) - 1], $activityobject);
                        if($nextcolumn >= $columns){
                            $column = array();
                            array_push($column, $activityobject);
                            array_push($daylistcolumns[count($daylistcolumns) - 1], $column);
                        }
                        else{
                            array_push($daylistcolumns[count($daylistcolumns) - 1][$nextcolumn], $activityobject);
                        }
                    }
                }
                else{
                    $daytime = array();
                    $daycolumns = array();
                    $column = array();
                    $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], $activity['art_id'], 0, $number);
                    array_push($daytime, $activityobject);
                    array_push($daylisttime, $daytime);
                    array_push($column, $activityobject);
                    array_push($daycolumns, $column);
                    array_push($daylistcolumns, $daycolumns);
                }
                if(!in_array($activity['art_id'], $activityclasses)){
                    array_push($activityclasses, $activity['art_id']);
                }
                $activitybefore = $activity;
                $number++;
                $faktor = 0;
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

    function getNextColumn($activity, $day, $columns, $columnsless){
        if(strtotime($activity['startzeit']) - strtotime($day[$columns - $columnsless][count($day[$columns - $columnsless]) - 1]->getEndzeit()) < 0){
            if($columns > $columnsless){
                return getNextColumn($activity, $day, $columns, $columnsless + 1);
            }
            else{
                return $columns;
            }
        }
        else{
            $returncolumns = $columns;
            for ($i = 1; $i <= $columns; $i++){
                if(strtotime($activity['startzeit']) - strtotime($day[$columns - $i][count($day[$columns - $i]) - 1]->getEndzeit()) >= 0){
                    $returncolumns = $columns - $i;
                }
            }
            return $returncolumns;
        }
    }

    function setValuesDayList(){
        global $daylistcolumns, $daylisttime;
        foreach($daylisttime as $day){
            $gaptobefore = -10;
            $overlapping = 0;
            foreach($day as $activity){
                if(!isOverlapping($day, $activity)){
                    $gaptobefore += 10;
                    $overlapping = 0;
                }
                else{
                    if($overlapping == 0){
                        $gaptobefore += 10;
                    }
                    $overlapping++;
                }
                getHeight($activity);
                getWidth($daylistcolumns, $daylisttime, $day, $activity);
                getLeft($daylistcolumns, $daylisttime, $day, $activity);
                getTop($daylisttime, $day, $activity, $gaptobefore);
            }
        }
    }

    function getHeight($activity){
        $activity->setHeight("height: ".calculateHeight($activity->getStartzeit(), $activity->getEndzeit())."px;");
    }

    function getWidth($daylistcolumns, $daylisttime, $day, $activity){
        $allcolumns = count($daylistcolumns[array_search($day, $daylisttime)]);
        $column = $activity->getColumn();
        $widthnumber = 1;
        for($i = 1; $i <= $allcolumns - ($column + 1); $i++){
            foreach($daylistcolumns[array_search($day, $daylisttime)][$column + $i] as $activitytwo){
                if(!(strtotime($activity->getEndzeit()) <= strtotime($activitytwo->getStartzeit()) || strtotime($activitytwo->getEndzeit()) <= strtotime($activity->getStartzeit()))){
                    break 2;
                }
            }
            $widthnumber++;
        }
        if($widthnumber > 1){
            $width = "width: calc((100% - 30px) * (".$widthnumber." / ".$allcolumns."));";
        }
        else{
            $width = "width: calc(((100% - 30px) * (".$widthnumber." / ".$allcolumns.")) - 8px);";
        }
        $activity->setWidth($width);
    }

    function getLeft($daylistcolumns, $daylisttime, $day, $activity){
        $allcolumns = count($daylistcolumns[array_search($day, $daylisttime)]);
        $column = $activity->getColumn();
        $left = "left: calc(100% * (".$column." / ".$allcolumns."));";
        $activity->setLeft($left);
    }

    function getTop($daylisttime, $day, $activity, $gaptobefore){
        $diffrenceabsolute = calculateHeight($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit(), $activity->getStartzeit());
        $gapslength = getGapsLength($day, $activity);
        $topnumber =  ($diffrenceabsolute + $gaptobefore) - $gapslength;
        $top = "top: ".$topnumber."px;";
        $activity->setTop($top);
        return $gaptobefore;
    }

    function getGapsLength($day, $activity){
        global $daylistcolumns, $daylisttime;
        $gap = 0;
        foreach($daylistcolumns[array_search($day, $daylisttime)][0] as $activitytwo){
            if($activity->getNumber() >= $activitytwo->getNumber()){
                $gapshort = calculateHeight(getBiggestEnd($day, $activitytwo), $activitytwo->getStartzeit());
                if($gapshort > 0){
                    $gap += $gapshort;
                }
            }
        }
        return $gap;
    }

    function getBiggestEndHeight($day){
        global $daylisttime;
        $biggestendnumber = 0;
        $biggestend;
        foreach($daylisttime[array_search($day, $daylisttime)] as $activitytwo){
            $end = strtotime($activitytwo->getEndzeit());
            if($end > $biggestendnumber){
                $biggestendnumber = $end;
                $biggestend = $activitytwo->getEndzeit();
            }
        }
        return $biggestend;
    }

    function getBiggestEnd($day, $activity){
        global $daylisttime;
        $biggestendnumber = 0;
        $biggestend;
        foreach($daylisttime[array_search($day, $daylisttime)] as $activitytwo){
            if(strtotime($activitytwo->getStartzeit()) < strtotime($activity->getStartzeit())){
                $end = strtotime($activitytwo->getEndzeit());
                if($end > $biggestendnumber){
                    $biggestendnumber = $end;
                    $biggestend = $activitytwo->getEndzeit();
                }
            }
        }
        if($biggestend == NULL){
            $biggestend = $activity->getStartzeit();
        }
        return $biggestend;
    }

    function isOverlapping($day, $activity){
        global $daylistcolumns, $daylisttime;
        $allcolumns = count($daylistcolumns[array_search($day, $daylisttime)]);
        $column = $activity->getColumn();
        for($i = 1; $i <= $allcolumns - ($column + 1); $i++){
            foreach($daylistcolumns[array_search($day, $daylisttime)][$column + $i] as $activitytwo){
                if(!(strtotime($activity->getEndzeit()) <= strtotime($activitytwo->getStartzeit()) || strtotime($activitytwo->getEndzeit()) <= strtotime($activity->getStartzeit()))){
                    return true;
                }
            }
        }
        for($i = 1; $i < $column + 1; $i++){
            foreach($daylistcolumns[array_search($day, $daylisttime)][$column - $i] as $activitytwo){
                if(!(strtotime($activity->getEndzeit()) <= strtotime($activitytwo->getStartzeit()) || strtotime($activitytwo->getEndzeit()) <= strtotime($activity->getStartzeit()))){
                    return true;
                }
            }
        }
        return false;
    }

    function calculateHeight($starttime, $endtime){
        $minutes = round((strtotime($endtime) - strtotime($starttime)) / 60,0);
        return $minutes;
    }
    
    function colorDay($activity, $datenow){
        if(strtotime(date("Y-m-d", strtotime($datenow))) != strtotime(date("Y-m-d", strtotime($activity->getStartzeit())))){
            return 'color: grey;';
        }
        else if(date("Y-m-d", strtotime($datenow)) == date("Y-m-d", strtotime($activity->getStartzeit()))){
            return 'color: #584125;';
        }
    }
?>