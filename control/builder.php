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
							}
						}
						elseif ($file == 'validate_anmelden.php') {
							
						}
						else {
							if(!$_SESSION['benutzer']){
								$file = './view/login.php';
							}
						}
						require_once $file; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
	}
?>