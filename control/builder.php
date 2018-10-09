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
		$targetarray = explode(".",$target);
		$targetstring = $targetarray[count($targetarray) - 2];
		$targetarray2 = explode("/",$targetstring);
		$finalstring = $targetarray2[count($targetarray2) - 1];

		$stackstring = $_SESSION['stack'];
		$stackarray = explode("/",$stackstring);
		$finalstringbefore = $stackarray[count($stackarray) - 2];

		$_SESSION['stack'] .= $finalstring.'/';

		/*if(in_array($finalstring, $stackarray)){
			if($finalstringbefore != $finalstring){
				
			}
			$number = array_search($finalstring, $stackarray);
			foreach($stackarray as $value){
				$i = 0;
				while($i <= $number){
					$finalstackarray[$i] = $value;
					$i++;
				};
				$finalstring = implode("",$finalstackarray);
				$_SESSION['stack'] = $finalstring;
			}
		}*/
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
?>