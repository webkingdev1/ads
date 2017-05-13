<?php

if(isset($_POST['login']) && isset($_POST['password'])) {
	$msg = login($_POST);
	if($msg == TRUE) {
		header("Location:index.php");
	}
	else {
		$_SESSION['msg'] = $msg;
		header("Location:".$_SERVER['PHP_SELF']);
	}
	exit();
}

if(isset($_GET['logout'])) {
	$msg = logout();
	if($msg === TRUE) {
		header("Location:".$_SERVER['PHP_SELF']);
		exit();
	}
}

$content = render(TEMPLATE."login.tpl",array("test"=>"nine"));
?>