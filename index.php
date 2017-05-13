<?php
	session_start();
	header("Content-Type:text/html;charset=UTF-8");
	require_once "config.php";
	require_once "functions.php";
	db(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$user = check_user();
	$id = $_GET['id'];
	$action = clear_string($_GET['action']);

		if(!$action){
			$action = 'main';
		}
		if(file_exists(ACTIONS.$action.".php")){
			include ACTIONS.$action.".php";
		}
		else {
			include ACTIONS."main.php";
		}
	require_once TEMPLATE."/index.php";
?>