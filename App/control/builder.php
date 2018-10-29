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
						/*if($_SESSION['benutzer_app']){
							if(inSessionInvalid($path)){
								header('Location: home');
							}
						}
						else{
							if(!inSessionValid($path)){
								header('Location: home');
							}
						}*/
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
		array_diff($invalidfiles, $files);
		$_SESSION['invalidfiles'] = $invalidfiles;
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
		array_diff($validfiles, $files);
		$_SESSION['validfiles'] = $validfiles;
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
?>