<h1>Оформление заказа</h1>

<?if($error){ echo $error;}?><br/>
<?if($dislpay_form){?>
<form action="" method="post" class="registration">
	<table border="1"  class="table_form">
		<tr>
			<th>Ф.И.О.:</th>
			<td>
				<input type="text" name="name" value="<?=($user_data['name']) ? $user_data['name'] : $_REQUEST['name']?>"/>
			</td>
		</tr>
		<tr>
			<th>Телефон:</th>
			<td>
				<input type="text" name="phone" value="<?=($user_data['phone']) ? $user_data['phone'] : $_REQUEST['phone']?>"/>
			</td>
		</tr>
		<tr>
			<th>E-mail:</th>
			<td>
				<input type="text" name="email" value="<?=($user_data['email']) ? $user_data['email'] : $_REQUEST['email']?>"/>
			</td>
		</tr>
		<tr>
			<th>Адрес:</th>
			<td>
				<textarea name="adress"><?=($user_data['adress']) ? $user_data['adress'] : $_REQUEST['adress']?></textarea>
			</td>
		</tr>
	</table>
	<br/>
	<input type="submit" class="table_submit" style="width: auto;" name="send" value="Отправить данные">
</form>
<? 
}else 
	echo $message; 
?> 

