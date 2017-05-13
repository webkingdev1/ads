<div class="container">
		<? $user = check_user();?>
			<h2>Объявления</h2>
 		<div id="search" class="row">
				<div class="col-md-1"><strong>Авто</strong>
			    	<input type="text" name="car" id="car" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
				</div>
			    <div class="col-md-1"><strong>Модель</strong>
			    	<input type="text" name="model" id="model" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
				</div>
			    <div class="col-md-1"><a id="down" href="?action=main&sort=asc">&darr;</a><strong>Цена</strong><a id="up" href="?action=main&sort=desc">&uarr;</a>
					<input type="text" name="price" id="price" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
			    </div>
			    <div class="col-md-1"><strong>Год</strong>
			    	<input type="text" name="year" id="year" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
			    </div>
			    <div class="col-md-1"><strong>Пробег</strong>
					<input type="text" name="mileage" id="mileage" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
			    </div>
			    <div class="col-md-2"><strong>Область</strong>
			    	<input type="text" name="region" id="region" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
			    </div>
			    <div class="col-md-1"><strong>Город</strong>
			    	<input type="text" name="city" id="city" placeholder="Найти" style="width:100%;" onKeyUp="carSelect();">
			    </div>
			</div>
			<div id="filter" style="visibility: hidden;"></div>
		  	 <br><hr>
		<div id="ads">
		  	<?php
		  	$page = $_GET['page'];
	 		if(($page <1) || ($page == "")) $page = 1;
 			$limit = 5;
 			$start = get_start($page, $limit);
 			$ads = get_ads_limit($start, $limit);
		  		foreach($ads as $item) :?> 
					<div class="row list">
						<span class="cell_name col-md-1"><?= $item['car'];?></span>
						<span class="cell_model col-md-1"><?= $item['model'];?></span>
						<span class="cell_price col-md-1"><?= $item['price'];?></span>
						<span class="cell_year col-md-1"><?= $item['year'];?></span>
						<span class="cell_mileage col-md-1"><?= $item['mileage'];?></span>
						<span class="cell_region col-md-2"><?= $item['region'];?></span>
						<span class="cell_city col-md-1"><?= $item['city'];?></span>
					<?php if($user['user_id'] == $item['id_user']): ?>	
						<button type="button" style="font-size:11px;margin: 5px;" class="cell_edit btn btn-danger col-md-1" onclick="location.href= '?action=edit&id=<?= $item['id']; ?>' ">Редактировать</button>
						<button type="button" style="font-size:11px;margin: 5px;" class="cell_edit btn btn-danger col-md-1" onclick="location.href= '?action=delete_ads&id=<?= $item['id']; ?>' ">Удалить</button>
					<?php elseif(!$user || $user['id_role'] != 1): ?>
						<button type="button" style="font-size:11px;margin: 5px;" class="cell_edit btn btn-warning col-md-1 col-md-offset-1" onclick="location.href= '?action=view&id_view=<?= $item['id']; ?>' ">Просмотреть</button>
					<?php elseif($user['id_role'] == 1) :?>
						<button type="button" style="font-size:11px;margin: 5px;" class="cell_edit btn btn-warning col-md-1 col-md-offset-1" onclick="location.href= '?action=view&id_view=<?= $item['id']; ?>' ">Просмотреть</button>
						<button type="button" style="font-size:11px;margin: 5px;" class="cell_deletes btn btn-danger col-md-1" onclick="if (confirm('<?= $user['name'] ;?>, удалить объявление?')) location.href = '?action=delete_ads&id=<?= $item['id']; ?>'">Удалить</button>
					<?php endif; ?>	
						<br>
				  	</div>
		  	<?php endforeach;?>
			<div class="row pagination"> 
				<?= pagination($page, $limit);?>
			</div> 
		</div> 

<script type="text/javascript">
	function carSelect(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","select.php?car="+document.getElementById("car").value
								+"&model="+document.getElementById("model").value
								+"&price="+document.getElementById("price").value
								+"&year="+document.getElementById("year").value
								+"&mileage="+document.getElementById("mileage").value
								+"&region="+document.getElementById("region").value
								+"&city="+document.getElementById("city").value,false)
		xmlhttp.send(null);
		document.getElementById("filter").innerHTML=xmlhttp.responseText;
		document.getElementById("filter").style.visibility='visible';
		document.getElementById("ads").style.display='none';
		document.getElementById("up").style.visibility='hidden';
		document.getElementById("down").style.visibility='hidden';
	}	
</script>	


