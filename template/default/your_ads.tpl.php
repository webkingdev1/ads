
<div class="container">
			<h2>Объявления</h2>
			<div class="row">
				<div class="col-md-1"><strong>Авто</strong></div>
			    <div class="col-md-1"><strong>Модель</strong></div>
			    <div class="col-md-1"><strong>Цена</strong></div>
			    <div class="col-md-1"><strong>Год выпуска</strong></div>
			    <div class="col-md-1"><strong>Пробег</strong></div>
			    <div class="col-md-2"><strong>Область</strong></div>
			    <div class="col-md-1"><strong>Город</strong></div>
			    <div class="col-md-4">
				</div>
			 <br><hr>	
		 	</div>
		  	<?php $user = check_user();
		  	 $ads = get_your_ads($_GET['id']);
		  		 foreach($ads as $item) :?> 
					<div class="row list">
					<?php if($user['id_role'] == 1):?>
						<span class="cell_id col-md-1"><?= $item['id'];?></span>
					<?php endif;?>
						<span class="cell_name col-md-1"><?= $item['car'];?></span>
						<span class="cell_model col-md-1"><?= $item['model'];?></span>
						<span class="cell_price col-md-1"><?= $item['price'];?></span>
						<span class="cell_year col-md-1"><?= $item['year'];?></span>
						<span class="cell_mileage col-md-1"><?= $item['mileage'];?></span>
						<span class="cell_region col-md-2"><?= $item['region'];?></span>
						<span class="cell_city col-md-1"><?= $item['city'];?></span>
						
						<button type="button" style="font-size:11px;margin:0 5px;" class="cell_edit btn btn-danger col-md-1" onclick="location.href= '?action=edit&id=<?= $item['id']; ?>' ">Редактировать</button>
						<button type="button" style="font-size:11px;margin:0 5px;" class="cell_edit btn btn-danger col-md-1" onclick="location.href= '?action=delete_ads&id=<?= $item['id']; ?>' ">Удалить</button>
						<button type="button" style="font-size:11px;margin:0 5px;" class="cell_edit btn btn-warning col-md-1 col-md-offset-1" onclick="location.href= '?action=view&id_view=<?= $item['id']; ?>' ">Просмотреть</button>
						<br>
				  	</div>
		  	<?php endforeach;?>

		  	 <button type="button" class="cell_main btn btn-warning" onclick="location.href= '?action=main' ">Вернуться назад</button>
			
			
		<?php if($navigation) :?>
			<div class="row navigation">
				<ul class="pager col-md-3">

					<?php if($navigation['first']) :?>
						<li>
							<a href="?action=main&page=1">First</a>
						</li>
					<?php endif; ?>

					<?php if($navigation['previous']):?>
						<?php foreach($navigation['previous'] as $page):?>
						<li>
							<a href="?action=main&page=<?php echo $page;?>"><?php echo $page;?></a>
						</li>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if($navigation['current']):?>
						<li">
							<strong><a href="?action=main&page=<?php echo $navigation['current'];?>"><?php echo $navigation['current'];?></a></strong>
						</li>
					<?php endif; ?>

					<?php if($navigation['next']):?>
						<?php foreach($navigation['next'] as $page):?>
						<li>
							<a href="?action=main&page=<?php echo $page;?>"><?php echo $page;?></a>
						</li>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if($navigation['last']) :?>
						<li>
							<a href="?action=main&page=<?php echo $navigation['last'];?>">Last</a>
						</li>
					<?php endif; ?>

				</ul>

				<ul class="pager col-md-8">
						<li>
							<a href="?action=main&perpage=3">3</a>
						</li>
					
						<li>
							<a href="?action=main&perpage=5">5</a>
						</li>
								
						<li>
							<a href="?action=main&perpage=7">7</a>
						</li>
				</ul>
			</div>
		<?php endif; ?>	
</div>


