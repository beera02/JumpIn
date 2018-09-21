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

	function getDatabase(){
        $db = array("localhost", "jumpin", "1234", "jumpin");
        return $db;
	}
	
	function getAllUser(){
		$dbarray = getDatabase();
		$db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
		$sql = ("SELECT * FROM BENUTZER");
		return ($db->query($sql)); 
	}

	function getUserByID($id){
		$dbarray = getDatabase();
		$db = new Mysqli($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
		$sql = ("SELECT * FROM BENUTZER WHERE id_benutzer = '$id'");
		$userbyid = $db->query($sql);
		$datensatz = mysqli_fetch_assoc($userbyid);
		return $datensatz;
	}
?>