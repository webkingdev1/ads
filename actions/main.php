<?php
if($_GET['page']){
	$page=(int)$_GET['page'];
		if(!$page){
			$page = 1;
		} 
} else {
	$page = 1;
}

if($_GET['perpage']){
	$perpage=(int)$_GET['perpage'];
		if(!$perpage){
			$perpage =5;
		} 
} else {
	$perpage = 2;
}

$content = render (TEMPLATE."main.tpl", array("test"=>"nine"));
?>