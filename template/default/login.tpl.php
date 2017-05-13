<div class="registr">
<h2>Войти в кабинет</h2>
			<?=$_SESSION['msg'];?>
			<? unset($_SESSION['msg'])?>
				<form method='POST'>
				Логин<br>
					<input type='text' name='login'>
				<br>
				Пароль<br>
					<input type='password' name='password'>
				<br>
				<br />
					<p>
					<button class="btn btn-info" type='submit' name='reg'>Войти</button>
					<button type="button" class="cell_main btn btn-warning" onclick="location.href= '?action=main' ">Вернуться</button>
					</p>
				</form>
</div>