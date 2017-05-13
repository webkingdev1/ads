
<div class="registr">
<h2>Регистрация</h2>
	<?=$_SESSION['msg'];?>
	<? unset($_SESSION['msg']);?>
		<form method='POST'>
		Логин<br>
			<input type='text' name='reg_login' value="<?=$_SESSION['reg']['login'];?>">
		<br>
		Пароль<br>
			<input type='password' name='reg_password'>
		<br>
		Подтвердить пароль<br>
			<input type='password' name='reg_password_confirm'>
		<br>
		Имя<br>
			<input type='text' name='reg_name' value="<?=$_SESSION['reg']['name'];?>">
		<br>
		<br>
		<button class="btn btn-info" type='submit' name='reg'>Регистрация</button>
		<button type="button" class="cell_main btn btn-warning" onclick="location.href= '?action=main' ">Вернуться</button>
	</form>
</div>