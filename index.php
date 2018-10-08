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
			case 'aktivitaetsart_add':
				build('./view/aktivitaetsart_add.php');
				break;
			case 'aktivitaetsart_edit_choice':
				build('./view/aktivitaetsart_edit_choice.php');
				break;
			case 'aktivitaetsart_edit':
				build('./view/aktivitaetsart_edit.php');
				break;
			case 'validate_aktivitaetsart_add':
				build('validate_aktivitaetsart_add.php');
				break;
			case 'validate_aktivitaetsart_edit':
				build('validate_aktivitaetsart_edit.php');
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
			case 'validate_user_add':
				build('validate_user_add.php');
				break;
			case 'user_group_add':
				build('./view/user_group_add.php');
				break;
			case 'validate_user_group_add':
				build('validate_user_group_add.php');
				break;
			case 'user_edit_choice':
				build('./view/user_edit_choice.php');
				break;
			case 'validate_user_edit_choice':
				build('validate_user_edit_choice.php');
				break;
			case 'user_edit':
				build('./view/user_edit.php');
				break;
			case 'user_group_edit':
				build('./view/user_group_edit.php');
				break;
			case 'validate_user_edit':
				build('validate_user_edit.php');
				break;
			case 'validate_user_group_edit':
				build('validate_user_group_edit.php');
				break;
			case 'group':
				build('./view/group.php');
				break;
			case 'group_add':
				build('./view/group_add.php');
				break;
			case 'group_edit_choice':
				build('./view/group_edit_choice.php');
				break;
			case 'group_edit':
				build('./view/group_edit.php');
				break;
			case 'validate_group_add':
				build('validate_group_add.php');
				break;
			case 'validate_group_edit':
				build('validate_group_edit.php');
				break;
			case 'reset':
				build('./view/reset.php');
				break;
			case 'validate_reset':
				build('validate_reset.php');
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
