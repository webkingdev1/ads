<!DOCTYPE HTML>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<title><?=SITE_NAME_HEADER;?></title>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="auth">
					<div class="col-xs-12 col-sm-5 col-md-5">
						<h2><a href="http://localhost/tz11">Авто-продажа</a></h2>
					</div>	
					<div class="basket col-xs-12 col-sm-7 col-md-7">
						<? if(!$user) : ?>
							<a href="?action=login">Вход</a>
							<a href="?action=registr">Регистрация</a>
						<?php else : ?>
							Привет, <?= $user['name'];?>.<br>
						<?php if($user['id_role'] !=1) : ?>
							<?php $user = check_user();?>
							<button type="button" class="cell_your_ads btn btn-success btn" onclick="location.href= '?action=your_ads&id=<?= $user['user_id'];?>' "> Ваши объявления</a></button>
						<? $count =	count_ads($user['user_id']);
						if($count < 3) : ?>
							<button type="button" class="cell_add_ads btn btn-success btn" onclick="location.href= '?action=add_ads' "> Добавить объявление</a></button>
						<?php endif; ?>	
						<?php endif; ?>	
						<?php if($user['id_role'] ==1) : ?>
							<button type="button" class="cell_add_car btn btn-success btn" onclick="location.href= '?action=add_car' ">Добавить авто</a></button>
						<?php endif; ?>	
							<button type="button" class="cell_exit btn btn-danger btn" onclick="location.href= '?action=login&logout=1' ">Выход</a></button>	   
						<?php endif; ?>	
					</div>
				</div>	
													
			</div>
		</div>
