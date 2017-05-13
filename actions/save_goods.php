<?php 
	$idGoods = (int)$_GET['id'];
	$editGoods = get_edit_goods($idGoods);
	
	$changeEdit = edit_goods($post,$editGoods['id']);
	
	$content = render (TEMPLATE."main.tpl", array('test'=>"nine"));
?>