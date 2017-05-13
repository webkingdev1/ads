<?php
	require_once "config.php";
	require_once "functions.php";
	foreach($_GET as $item => $value){
		if ($value != ""){
			$arr[]=$item;
			$val[]=$value;
		}
	}
	$car = $arr[0]." like ('".$val[0]."%')";
	for($i=1; $i<count($arr); $i++){
		$car .=" AND ".$arr[$i]." like ('".$val[$i]."%')";
	}
	if(isset($arr)){
	db(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$sql = ("SELECT * FROM ".PREF."ads AS ad JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												 JOIN ".PREF."model AS m ON m.id_model=ad.id_model
												 JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												 JOIN ".PREF."region AS r ON r.id_region=ad.id_region
												WHERE $car");
	$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){?>
			<div class="row">
			<span class="cell_car col-md-1"><?= $row['car'];?></span>
			<span class="cell_model col-md-1"><?= $row['model'];?></span>
			<span class="cell_price col-md-1"><?= $row['price'];?></span>
			<span class="cell_year col-md-1"><?= $row['year'];?></span>
			<span class="cell_mileage col-md-1"><?= $row['mileage'];?></span>
			<span class="cell_region col-md-2"><?= $row['region'];?></span>
			<span class="cell_city col-md-1"><?= $row['city'];?></span>
			<button type="button" style="font-size:11px;margin: 5px;" class="cell_edit btn btn-warning col-md-1 col-md-offset-1" onclick="location.href='?action=view&id_view=<?= $row['id']; ?>'">Просмотреть</button>
			</div>
			<?
		}
	}
?>