<?php
$idads = (int)$_GET['id'];
$editads = get_edit_ads($idads);

$changeEdit = delete_ads($editads['id']);

$content = render (TEMPLATE."main.tpl", array('test'=>"eight"));
?>