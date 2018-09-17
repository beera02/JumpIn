<?php
	include_once 'control/builder.php';	
	$temp = trim($_SERVER['REQUEST_URI'], '/');
	$url = explode('/', $temp);
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();


	if(!empty($url[1])){
		$url[1] = strtolower($url[1]);
		switch($url[1]){
			case 'validate_anmelden':
				build('validate_anmelden.php');
				break;
			case 'home':
				build('./view/home.php');
				break;
			case 'logout':
				build('logout.php');
				break;
			default:
				build('./view/login.php');
				break;
		}
	}
	else{
		build('./view/login.php');
	}
?>
