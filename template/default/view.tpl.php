	
	<div class="container">
	<?php 
	$idads = (int)$_GET['id_view'];
	$viewads = get_view_ads($idads);
	$user = check_user();
	?>
	<h2>Просмотр объявления</h2>
	
	<form method="POST" action="?action=main" class="view_ads">
			
				<div class="col-md-3"><img style="float:left; width:300px;" src="<?php echo $viewads['car_img'];?>">
				</div>
			<div class="row list">
				<div class="col-md-3">
					<input type="hidden" name="id" value="<?php echo $viewads['id'];?>">
					<p>Автомобиль:<br> <?= ($viewads['car']) ;?></p>
					<p>Цена:<br><?= $viewads['price'];?> $. </p> 
					<p>Пробег:<br><?= $viewads['mileage'];?> км. </p> 
					<p>Год выпуска:<br><?= $viewads['year'];?></p>
				</div>
				<div class="col-md-4">
					<p>Объем двигателя:<br><?= $viewads['engine_capacity'];?> л.</p>
					<p>Город:<br><?= $viewads['city'];?></p>
					<p>Область:<br><?= $viewads['region']; ?></p>
			  	</div>
			
			</div>

			 <button type="button" class="cell_main btn btn-warning" onclick="location.href= '?action=main' ">Вернуться назад</button>
			<? if($user['id_role'] == 2) : ?>
			<button type="button" class="cell_buy btn btn btn-danger" onclick="location.href='?action=add_to_basket&id=<?php echo $idGoods;?>'">Купить</button>
			<?php endif ?>
	</form>			 
			
	