<?php
	include_once 'control/builder.php';	
	$temp = trim($_SERVER['REQUEST_URI'], '/');
	$url = explode('/', $temp);
	error_reporting(E_ALL & ~E_NOTICE);
	$_SESSION['benutzer'] = 'xyz';
	session_start(); 


	if(!empty($url[2])){
		$url[2] = strtolower($url[2]);
		switch($url[2]){
			case 'login':
				build('./view/login.php');
				break;
			default:
				build('./view/home.php');
				break;
		}
	}
	else{
		build('./view/home.php');
	}
?>