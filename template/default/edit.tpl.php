	
	<div class="conteiner">
	<?php 
	$editads = get_edit_ads((int)$_GET['id']);
	?>
	<h2>Редактировать товар</h2>
	<form method="POST" action="?action=save_ads&id=<?= $editads['id'];?>" class="edit_ads">
				<p>Авто:</p> <input type="text" name="ads_name" value="<?= $editads['car'];?>">
				<p>Модель:</p> <input type="text" name="ads_model" value="<?= $editads['model'];?>">
				<p>Цена:</p> <input type="text" name="ads_price" value="<?php echo $editads['price'];?>">
				<p>Год выпуска:</p> <input type="text" name="ads_year" value="<?= $editads['year'];?>">
				<p>Пробег:</p> <input type="text" name="ads_mileage" value="<?= $editads['mileage'];?>">
				<p>Область:</p> <input type="text" name="ads_region" value="<?= $editads['region'];?>">
				<p>Город:</p> <input type="text" name="ads_city" value="<?= $editads['city'];?>">
				</div>
			<br>
			<div>
				 <button type="submit" name='submit' onclick="location.href= '?action=main'" class="cell_save btn btn-success">Сохранить</button>
				 <button type="button"  class="cell_main btn btn-warning" onclick="location.href= '?action=main'">На главную</button>
			</div>
	</form>