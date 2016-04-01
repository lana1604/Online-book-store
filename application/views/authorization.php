<h1>Авторизация</h1>

<?= $message?>
<?if($dislpay_form):?>

<form action="" method="post">
<table border="1"  class="table_form">
	<tr>
		<th>Логин:</th>
		<td><input type="text" name="login" value="<?=$_REQUEST['login']?>"/></td>
	</tr>
	<tr>
		<th>Пароль:</th>
		<td><input type="password" name="pass" value="<?=$_REQUEST['pass']?>"/></td>
	</tr>
</table>
<br/>
<input type="submit" class="table_submit" style="width: auto; margin-right: 415px;" name="send" value="Отправить данные">
</form>

<? endif;?>
