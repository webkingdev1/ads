<?php 
	$idCat = (int)$_GET['id'];
	$editCat = get_edit_cat($idCat);
	
	$changeEdit = edit_cat($post,$editCat['id']);
	
	$content = render (TEMPLATE."main.tpl", array('test'=>"nine"));
?>