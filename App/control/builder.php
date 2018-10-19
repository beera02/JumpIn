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
						require_once $path; 
					?> 
				</main>
			</body>
		</html>
		<?php	 
    }
    
    require_once '../Konfiguration/control/database.php'; 
?>