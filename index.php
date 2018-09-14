<?php
	include_once 'control/builder.php';	
	$temp = trim($_SERVER['REQUEST_URI'], '/');
	$url = explode('/', $temp);	

	if(!empty($url[1])){
		$url[1] = strtolower($url[1]);
		switch($url[1]){
			default:
				build('login.php');
				break;
		}
	}
	else{
		build('login.php');
	}
?>
