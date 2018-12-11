<?php
    class Activity{
        private $id_aktivitaet;
        private $aktivitaetsname;
        private $startzeit;
        private $endzeit;
        private $height;
        private $width;
        private $left;
        private $top;
        private $column;
        private $number = 0;

        public function __construct($id_aktivitaet, $aktivitaetsname, $startzeit, $endzeit, $column, $number) {
            $this->id_aktivitaet = $id_aktivitaet;
            $this->aktivitaetsname = $aktivitaetsname;
            $this->startzeit = $startzeit;
            $this->endzeit = $endzeit;
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
    global $daylistcolumns, $daylisttime;
    $daylistcolumns = array();
    $daylisttime = array();
    buildWeekschedule();

    function buildWeekschedule(){
        $userid = getUserIDByUsername($_SESSION['benutzer_app']);
        setDayList($userid);
        setValuesDayList();
        //printDebug();
        printWeekschedule();
    }

    function printDebug(){
        global $daylistcolumns, $daylisttime;
        foreach($daylistcolumns as $day){
            echo 'Tag<br>';
            foreach($day as $column){
                echo 'x x x Spalte<br>';
                foreach($column as $activity){
                    echo 'x x x x x x Name: '.$activity->getAktivitaetsname().'<br>';
                    echo 'x x x x x x Startzeit: '.$activity->getStartzeit().'<br>';
                    echo 'x x x x x x Endzeit: '.$activity->getEndzeit().'<br>';
                    echo 'x x x x x x Nummer: '.$activity->getNumber().'<br>';
                    echo 'x x x x x x Spalte: '.$activity->getColumn().'<br>';
                }
            }
        }
    }

    function printWeekschedule(){
        global $daylisttime;
        foreach($daylisttime as $day){
            echoDay($day[0]->getStartzeit(), colorDay($day[0], date('Y-m-d H:i:s')), getContainerHeight($day));
            foreach($day as $activity){
                echoActivity($activity->getStartzeit(), $activity->getEndzeit(), $activity->getAktivitaetid(), $activity->getAktivitaetsname(), $activity->getHeight(), $activity->getWidth(), $activity->getLeft(), $activity->getTop());
            }  
            echoCloseDay();
        }
    }

    function getContainerHeight($day){
        $height = 0;
        foreach($day as $activity){
            $height += calculateHeight($activity->getStartzeit(), $activity->getEndzeit()) + 20;
        }
        return "min-height: ".$height."px;";
    }

    function echoDay($starttime, $cssday, $containerheight){
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
                <div class="div_wochenplan_day_right" style="'.$containerheight.'">
        ';
    }

    function echoActivity($starttime, $endtime, $activityid, $activityname, $containerheight, $containerwidth, $left, $top){
        echo '
            <form action="wochenplan_view" method="post">
                <button class="button_wochenplan" style="'.$containerheight.' '.$containerwidth.' '.$left.' '.$top.'">
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

    function setDayList($userid){
        global $daylistcolumns, $daylisttime;
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
                        $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], 0, $number);
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
                        $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], $nextcolumn, $number);
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
                    $activityobject = new Activity($activity['id_aktivitaet'], $activity['aktivitaetsname'], $activity['startzeit'], $activity['endzeit'], 0, $number);
                    array_push($daytime, $activityobject);
                    array_push($daylisttime, $daytime);
                    array_push($column, $activityobject);
                    array_push($daycolumns, $column);
                    array_push($daylistcolumns, $daycolumns);
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
            foreach($day as $activity){
                getHeight($activity);
                getWidth($daylistcolumns, $daylisttime, $day, $activity);
                getLeft($daylistcolumns, $daylisttime, $day, $activity);
                getTop($daylisttime, $day, $activity);
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

    function getTop($daylisttime, $day, $activity){
        $diffrenceabsolute = calculateHeight($daylisttime[array_search($day, $daylisttime)][0]->getStartzeit(), $activity->getStartzeit());
        $gapslength = getGapsLength($day, $activity);
        var_dump($gapslength);
        $topnumber =  $diffrenceabsolute - ($gapslength / 2);
        $top = "top: ".$topnumber."px;";
        $activity->setTop($top);
        /*echo '
            <div class="nowline" style="'.$margintopnowpointer.'"></div>
            <div class="nowpoint" style="'.$margintopnowpointer.'"></div>
        ';*/
    }

    function getGapsLength($day, $activity){
        global $daylistcolumns, $daylisttime;
        $gap = 0;
        foreach($daylistcolumns[array_search($day, $daylisttime)][0] as $activitytwo){
            if($activity->getNumber() >= $activitytwo->getNumber()){
                $gap += calculateHeight($activity->getStartzeit(), getBiggestEnd($day, $activitytwo));
            }
        }
        return $gap;
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