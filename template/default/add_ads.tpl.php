
<h2>Добавить новое объявление</h2>
<form method="POST" class="new_ads" enctype="multipart/form-data">
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Автомобиль:</p>
			<select class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1" name="id_сar">
				<?php $car = get_car();
				foreach ($car as $item) : ?>
				<option value="<?= $item['id_car']; ?>"> <?= $item['car'];?></option>	
				<?php endforeach; ?>
			</select></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Модель:</p>
			<select class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1"  name="id_model">
				<?php $model = get_model();
				foreach ($model as $item) : ?>
				<option value="<?= $item['id_model']; ?>"> <?= $item['model'];?></option>	
				<?php endforeach; ?>
			</select></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Цена:</p><input class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1"  name="id_model" type="text" style="color:#000;" name="price" placeholder="Цена" value=""></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Год выпуска:</p><input class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1" type="text" style="color:#000;" name="year" placeholder="Год выпуска" value=""></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Пробег:</p> <input class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1" type="text" style="color:#000;" name="mileage" placeholder="Пробег" value=""></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Объем двигателя:</p><input class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1" type="text" style="color:#000;" name="engine_capacity" placeholder="Объем двигателя" value=""></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Город:</p>
			<select class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1"  name="id_city">
				<?php $city = get_city();
				foreach ($city as $item) : ?>
				<option value="<?php echo $item['id_city']; ?>"> <?php echo $item['city'];?>
				</option>	
				<?php endforeach; ?>
			</select></span>
		<span><p class="col-xs-12 col-sm-5 col-md-4 col-md-offset-3">Изображение:</p><input  class="col-xs-12 col-sm-5 col-md-2 col-md-offset-1" type="file" name="car_img" value=""></span>
		</br>
	<span class="row add_button">
		<button type="submit" class="cell_add btn btn-success" onclick="location.href= '?action=main' ">Добавить объявление</button>
		</br>
		<button type="button" class="cell_main btn btn-warning" onclick="location.href= '?action=main' ">Вернуться назад</button>
	 </span>
</form>


