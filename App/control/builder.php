<?php
    function build($path){
?>
        <!DOCTYPE html>
		<html>
			<head>
				<title>Jump-In App</title>
				<link rel="stylesheet" href="./css/style.css">
				<meta charset="UTF-8">
			</head>
			<body>
				<?php
					require_once './view/header.php'; 
				?> 
				<main>
					<?php
						if($_SESSION['benutzer_app']){
							if(inSessionInvalid($path)){
								$path = "./view/home.php";
							}
						}
						else{
							if(!inSessionValid($path)){
								$path = "./view/home.php";
							}
						}
						require_once $path; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
    }
    
	require_once '../Konfiguration/control/database.php'; 
	
	function addSessionInvalid($file){
		$invalidfiles = $_SESSION['invalidfiles'];
		array_push($invalidfiles, $file);
		$_SESSION['invalidfiles'] = $invalidfiles;
	}

	function removeSessionInvalid($files){
		$invalidfiles = $_SESSION['invalidfiles'];
		$difference = array_diff($invalidfiles, $files);
		$_SESSION['invalidfiles'] = $difference;
	}

	function inSessionInvalid($file){
		$invalidfiles = $_SESSION['invalidfiles'];
		if(in_array(splitString($file), $invalidfiles)){
			return true;
		}
		else{
			return false;
		}
		
	}

	function addSessionValid($file){
		$validfiles = $_SESSION['validfiles'];
		array_push($validfiles, $file);
		$_SESSION['validfiles'] = $validfiles;
	}

	function removeSessionValid($files){
		$validfiles = $_SESSION['validfiles'];
		$difference = array_diff($validfiles, $files);
		$_SESSION['validfiles'] = $difference;
	}

	function inSessionValid($file){
		$validfiles = $_SESSION['validfiles'];
		if(in_array(splitString($file), $validfiles)){
			return true;
		}
		else{
			return false;
		}
	}

	function splitString($string){
		$stringarray = explode("/", $string);
		$stringarray2 = explode(".", $stringarray[(count($stringarray) - 1)]);
		return $stringarray2[0];
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
	
	function getWriteinPossebilities($source){
		$arts = getAllArts();
		$i = 1;
		$return = [];
		$userid = getUserIDByUsername($_SESSION['benutzer_app']);
        while($row1 = mysqli_fetch_assoc($arts)){
            if($row1['einschreiben'] == "1"){
                $activityentities = getActivityentitiesByArtID($row1['id_art']);
                while($row2 = mysqli_fetch_assoc($activityentities)){
                    if(strtotime(date("Y-m-d H:i:s")) - strtotime($row2['einschreibezeit']) >= 0){
						if(getValidActivityentities($row2['id_aktivitaetblock'], $userid)){
							$activities = getActivityByActivityentityIDAndUserID($row2['id_aktivitaetblock'], $userid);
							while($row3 = mysqli_fetch_assoc($activities)){
								$writtenin = getWrittenIn($userid, $row3['id_aktivitaet']);
								if(strtotime($row3['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0 & empty($writtenin['aktivitaet_id'])){
									if($source == 'home'){
										echo '
											<form class="form_home" action="einschreiben_choice" method="post">
												<button class="button_home section'.$row1['name'].'">
													<p class="p_section">'.$row1['name'].'</p>
												</button>
												<input type="hidden" name="id" value="'.$row1['id_art'].'">
											</form>
										';
									}
									else if($source == 'header'){
										$return = '
											<form action="einschreiben_choice" method="post">
												<button class="button_navigation">
													<a class="a_header_special" href="">
														'.$row1['name'].'
													</a>
												</button>
												<input type="hidden" name="id" value="'.$row1['id_art'].'">
											</form>
										';
									}
									$i++;
									break 2;
								}
							}
						}
                    }
                }
            }
		}
		if(!empty($return)){
			return $return;
		}
	}

	function getValidActivityentities($activityentityid, $userid){
		$counter = 0;
		$activities = getActivityAndWrittenInByActivityentityIDAndUserID($activityentityid, $userid);
		while($row = mysqli_fetch_assoc($activities)){
			if(strtotime($row['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0){
				if($row['aktivitaet_id'] != NULL){
					$counter++;
				}
			}
		}
		if($counter > 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
?>