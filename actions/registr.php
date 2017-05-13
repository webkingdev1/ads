<?php
$content = render(TEMPLATE."registr.tpl",array("test"=>"nine"));

if(isset($_POST['reg'])) {
	
	$msg = registration($_POST);
	if($msg == TRUE) {
	echo $_SESSION['msg'] = "Успешная регистрация";

	}
	else {
		$_SESSION['msg'] = $msg;
	}
	header('Location:index.php?action=login');
}


?>