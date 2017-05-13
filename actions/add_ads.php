<?php
if ($_POST){
	$msg = add_new_ads($_POST);
	if ($msg === TRUE){
		$_SESSION["msg"] = "Объявление добавлено";
	}
	else {
		echo $_SESSION["msg"];
	}
}
$content = render(TEMPLATE."add_ads.tpl", array("test"=>"nine"));
?>