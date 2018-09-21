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
			case 'allgemein':
				build('./view/allgemein.php');
				break;
			case 'aktivitaetsart':
				build('./view/aktivitaetsart.php');
				break;
			case 'aktivitaet':
				build('./view/aktivitaet.php');
				break;
			case 'steckbrief':
				build('./view/steckbrief.php');
				break;
			case 'notfallkarte':
				build('./view/notfallkarte.php');
				break;
			case 'feedback':
				build('./view/feedback.php');
				break;
			case 'user':
				build('./view/user.php');
				break;
			case 'user_add':
				build('./view/user_add.php');
				break;
			case 'user_edit':
				build('./view/user_edit.php');
				break;
			case 'validate_user_add':
				build('validate_user_add.php');
				break;
			case 'user_add_group_add':
				build('./view/user_add_group_add.php');
				break;
			case 'validate_user_add_group_add':
				build('validate_user_add_group_add.php');
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
