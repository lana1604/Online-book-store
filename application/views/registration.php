<h1>Регистрация</h1>

<?if($error){ echo $error;}?><br/>
<?if($dislpay_form){?>
<form action="" method="post" class="registration">
	<table border="1"  class="table_form">
		<tr>
			<th>Логин:</th>
			<td><input type="text" name="login" value="<?=$_REQUEST['login']?>"/></td>
		</tr>
		<tr>
			<th>Пароль:</th>
			<td><input type="text" name="pass" value="<?=$_REQUEST['pass']?>"/></td>
		</tr>
		<tr>
			<th>Ф.И.О.:</th>
			<td><input type="text" name="name" value="<?=$_REQUEST['name']?>"/></td>
		</tr>
		<tr>
			<th>Телефон:</th>
			<td><input type="text" name="phone" value="<?=$_REQUEST['phone']?>"/></td>
		</tr>
		<tr>
			<th>E-mail:</th>
			<td><input type="text" name="email" value="<?=$_REQUEST['email']?>"/></td>
		</tr>
		<tr>
			<th>Адрес:</th>
			<td><textarea name="adress"><?=$_REQUEST['adress']?></textarea></td>
		</tr>
	</table>
	<br/>
	<input type="submit" class="table_submit" style="width: auto;" name="send" value="Отправить данные">
</form>
<? 
}else 
	echo $message; 
?> 