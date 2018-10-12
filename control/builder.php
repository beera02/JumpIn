<?php
    function build($file){
?>
        <!DOCTYPE html>
		<html>
			<head>
				<title>Jump-In Konfiguration</title>
				<link rel="stylesheet" href="./css/style.css">
				<meta charset="UTF-8">
			</head>
			<body>
					<?php
						require_once './view/header.php'; 
					?> 
				<main>
					<?php
						if ($file == './view/login.php') {
							if($_SESSION['benutzer']){
								$file = './view/home.php';
								setStack($file);
							}
						}
						elseif ($file == 'validate_anmelden.php') {
							
						}
						else {
							if(!$_SESSION['benutzer']){
								$file = './view/login.php';
							}
							else{
								setStack($file);
							}
						}
						require_once $file; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
	}

    function setStack($target){
        $stackstring = $_SESSION['stack'];
		$stackarray = explode("/",$stackstring);
		$finalstringbefore = $stackarray[count($stackarray) - 2];

		$targetarray = explode(".",$target);
		$targetstring = $targetarray[count($targetarray) - 2];
		$targetarray2 = explode("/",$targetstring);
		$finalstring = $targetarray2[count($targetarray2) - 1];

		if($finalstringbefore != NULL){
			if(in_array($finalstring, $stackarray)){
				if($finalstringbefore != $finalstring){
					$number = array_search($finalstring, $stackarray);
					$i = 0;
					$finalstackarray = array();
					foreach($stackarray as $value){
						if($i <= $number){
							$finalstackarray[$i] = $value;
							$i++;
						}
					}
					$finalstring = implode("/", $finalstackarray);
					$finalstring = ''.$finalstring.'/';
					$_SESSION['stack'] = $finalstring;
				}
			}
			else{
				$_SESSION['stack'] .= $finalstring.'/';
			}
		}
		else{
			$_SESSION['stack'] .= $finalstring.'/';
		}
	}

	require_once 'database.php';

	function validateActivity($artofactivity, $startdate, $starttime, $enddate, $endtime, $writeindate, $writeintime){
		$startdatetime = validateDateTime($startdate, $starttime);
		$enddatetime = validateDateTime($enddate, $endtime);
		$artid = getArtIDByName($artofactivity);
		if($writeintime != null & $writeindate != null){
			$writeindatetime = validateDateTime($writeindate, $writeintime);
			return array("startzeit"=>$startdatetime, "endzeit"=>$enddatetime, "art_id"=>$artid, "einschreibezeit"=>$writeindatetime);
		}
		else{
			return array("startzeit"=>$startdatetime, "endzeit"=>$enddatetime, "art_id"=>$artid);
		}
	}

	function validateDateTime($date, $time){
		$time = strtotime($time);
		$date = strtotime($date);

		$hours = date('G', $time);
		$minutes = date('i', $time);
		$month = date('n', $date);
		$day = date('j', $date);
		$year = date('Y', $date);

		$newdate = mktime($hours,$minutes,0,$month,$day,$year);
		return date("Y-m-d H:i:s", $newdate);
	}

	function returnDate($olddate){
		return date("Y-m-d", strtotime($olddate));
	}

	function returnTime($oldtime){
		return date("H:i", strtotime($oldtime));
	}

	function getDaysHours($time){
		$trimmed1 = explode(' ',$time);
		$date1 = $trimmed1[0];
		$time1 = $trimmed1[1];

		$time2 = date('Y-m-d H:i:s');
		$trimmed2 = explode(' ', $time2);
		$date2 = $trimmed2[0];
		$time2 = $trimmed2[1];

		$days = (strtotime($date1) - strtotime($date2)) / (60*60*24);
		$minutes = round((strtotime($time1) - strtotime($time2)) / 60,0);

		if($days != 0){
			if($minutes < 0){
				$result = 'In weniger als ' . $days . ' Tag/en';
			}
			else{
				$result = 'In ' . $days . ' Tag/en und ' . $minutes . ' Minute/n';
			}
		}
		else{
			$result = 'In ' . $minutes . ' Minute/n';
		}
		return $result;
	}

	function getJaNein($id){
		if($id == 1){
			return 'Ja';
		}
		else{
			return 'Nein';
		}
	}
?>