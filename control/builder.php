<?php
	$year;
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
						require_once $file; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
	}
?>