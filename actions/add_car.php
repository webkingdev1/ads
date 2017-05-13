<?php
if ($_POST){
	$msg = add_new_car();
	if ($msg === TRUE){
		$_SESSION["msg"] = "Авто добавлено";
	}
	else {
		echo $_SESSION["msg"];
	}
}
 
$content = render(TEMPLATE."add_car.tpl", array("test"=>"nine"));
?>