<h1>Обратная связь</h1>
<?if($error){ echo $error;}?><br/>
<?if($dislpay_form){?>
	<form action="" method="post">
		<table border="1"  class="table_form"> 
		<tr>
			<th>Ф.И.О.</th>
			<td><input type="text" name="fio" value="<?=$_REQUEST['fio']?>"/></td>
		</tr>
		<tr>
			<th>E-mail</th>
			<td><input type="text" name="email" value="<?=$_REQUEST['email']?>"/></td>
		</tr>
		<tr>
			<th>Сообщение:</th>
			<td><textarea name="message"><?=$_REQUEST['message']?></textarea></td>
		</tr>
	</table>
	<br/>
	<input type="submit" class="table_submit" name="send" value="Отправить сообщение">
</form>
<?}
	else{ echo $message; };
?>
