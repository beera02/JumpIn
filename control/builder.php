<?php
	/*funktion für einen bestimmten main part zu laden
	$file ist der pfad des files welches geladen werden soll*/
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
					//es wird immer der selbe header genutzt
					require_once './view/header.php'; 
				?> 
				<main>
					<?php
						/*wenn der benutzer eine session bestehen hat
						und auf die login seite kommen will,
						kommt er stattdessen auf die home seite */
						if ($file == './view/login.php') {
							if($_SESSION['benutzer']){
								$file = './view/home.php';
								setStack($file);
							}
						}
						/*wenn der benutzer auf die validiere anmelden seite kommen will
						geschieht stattdessen nichts*/
						elseif ($file == 'validate_anmelden.php') {}
						else {
							/*wenn der benutzer keine session hat
							kommt er in jedem fall auf die login seite*/
							if(!$_SESSION['benutzer']){
								$file = './view/login.php';
							}
							//ansonsten wird das vorgesehene file in den stack geschrieben
							else{
								setStack($file);
							}
						}
						//lädt das file hinein
						require_once $file; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
	}

	//funktion für das geladene file in den stack zu schreiben
    function setStack($target){
		//holt den vorherigen stack aus der sessionvariable
        $stackstring = $_SESSION['stack'];
		$stackarray = explode("/",$stackstring);
		$finalstringbefore = $stackarray[count($stackarray) - 2];

		/*teilt den pfad des geladenen files
		nur noch auf das benötigte zu*/
		$targetarray = explode(".",$target);
		$targetstring = $targetarray[count($targetarray) - 2];
		$targetarray2 = explode("/",$targetstring);
		$finalstring = $targetarray2[count($targetarray2) - 1];

		//wenn zuvor schon etwas im stack war
		if($finalstringbefore != NULL){
			//wenn das zu ladende file zuvor schon im stack war
			if(in_array($finalstring, $stackarray)){
				//wenn das vorherige file nicht das zu ladende ist (F5 exception)
				if($finalstringbefore != $finalstring){
					//position vom zu ladenden file im vorherigen stack herausfinden
					$number = array_search($finalstring, $stackarray);

					//erstellen von iterator variable $i und array variable für die iterierten teile drin zu speichern
					$i = 0;
					$finalstackarray = array();
					//durch den vorherigen stack durchiterieren
					foreach($stackarray as $value){
						/*wenn die anzahl iterationen kleiner als die position
						vom zu ladenden file ist*/
						if($i <= $number){
							//den teil aus dem stack in das array schreiben und iterator variable um 1 erhöhen
							$finalstackarray[$i] = $value;
							$i++;
						}
					}
					//das array mit / zeichen zwischen den elementen zusammensetzen 
					$finalstring = implode("/", $finalstackarray);
					//am schluss ein / zeichen anfügen
					$finalstring = ''.$finalstring.'/';
					//den neuen stack setzen
					$_SESSION['stack'] = $finalstring;
				}
			}
			//ansonsten das neue file mit einem / appenden
			else{
				$_SESSION['stack'] .= $finalstring.'/';
			}
		}
		//ansonsten das neue file mit einem / appenden
		else{
			$_SESSION['stack'] .= $finalstring.'/';
		}
	}

	//alle datenbankmethoden aus dem file database.php laden
	require_once 'database.php';

	//funktion um alle benötigten attribute von einer aktivität zu validieren
	function validateActivity($artofactivity, $startdate, $starttime, $enddate, $endtime, $writeindate, $writeintime){
		//das format des datums und der zeit durch funktion validateDateTime ändern
		$startdatetime = validateDateTime($startdate, $starttime);
		$enddatetime = validateDateTime($enddate, $endtime);

		//die aktivitätsartid via des aktivitätsartnamens aus der datenbank holen
		$artid = getArtIDByName($artofactivity);
		//wenn es eine aktivität mit einschreiben ist
		if($writeintime != null & $writeindate != null){
			//das format des datums und der zeit von der einschreibzeit ändern
			$writeindatetime = validateDateTime($writeindate, $writeintime);
			//array mit allen benötigten daten zurückgeben
			return array("startzeit"=>$startdatetime, "endzeit"=>$enddatetime, "art_id"=>$artid, "einschreibezeit"=>$writeindatetime);
		}
		else{
			//array mit allen benötigten daten zurückgeben
			return array("startzeit"=>$startdatetime, "endzeit"=>$enddatetime, "art_id"=>$artid);
		}
	}

	//funktion um das format von datum und zeit zu ändern
	function validateDateTime($date, $time){
		//die string werte zu zeit werten machen
		$time = strtotime($time);
		$date = strtotime($date);

		//die stunden und minuten aus der zeit variable lesen
		$hours = date('G', $time);
		$minutes = date('i', $time);

		//den monat, den tag im monat und das yahr aus der datum variable lesen
		$month = date('n', $date);
		$day = date('j', $date);
		$year = date('Y', $date);

		//aus den herausgelesenen daten ein neues datum erstellen
		$newdate = mktime($hours,$minutes,0,$month,$day,$year);
		//dieses datum neu formatieren und zurückgeben
		return date("Y-m-d H:i:s", $newdate);
	}

	//funktion um das datum zurückzugeben
	function returnDate($olddate){
		return date("Y-m-d", strtotime($olddate));
	}

	//funktion um die zeit zurückzugeben
	function returnTime($oldtime){
		return date("H:i", strtotime($oldtime));
	}

	//funktion um anzahl tage und minuten bis zu einem zeitpunkt herauszufinden
	function getDaysHours($time){
		//datum und zeit bei leerzeichen trennen und dann einzeln als datum und zeit speichern
		$trimmed1 = explode(' ',$time);
		$date1 = $trimmed1[0];
		$time1 = $trimmed1[1];

		//jetziges datum und zeit holen, trennen, und einzeln als datum und zeit speichern
		$time2 = date('Y-m-d H:i:s');
		$trimmed2 = explode(' ', $time2);
		$date2 = $trimmed2[0];
		$time2 = $trimmed2[1];

		//anzahltage und anzahl minuten zwischen den daten und den zeiten ausrechnen
		$days = (strtotime($date1) - strtotime($date2)) / (60*60*24);
		$minutes = round((strtotime($time1) - strtotime($time2)) / 60,0);

		//wenn mehr als 1 tag differenz
		if($days != 0){
			//wenn es keine minuten hat
			if($minutes < 0){
				//speichern in wievielen tagen
				$result = 'In weniger als ' . $days . ' Tag/en';
			}
			else{
				//speichern in wievielen tagen und minuten
				$result = 'In ' . $days . ' Tag/en und ' . $minutes . ' Minute/n';
			}
		}
		else{
			//anzahl minuten speichern
			$result = 'In ' . $minutes . ' Minute/n';
		}
		//den string zurückgeben
		return $result;
	}

	/*funktion für ja/nein auszugeben wür eine zahl von 1 oder 0*/
	function getJaNein($id){
		if($id == 1){
			return 'Ja';
		}
		else{
			return 'Nein';
		}
	}
?>