<?
if($message) echo "$message";
?>
<h2>Поступившие заказы:</h2>
<?
if($orders){
	foreach($orders as $order){
?>

<h1>Заказ № <?= $order['id']?></h1>

<p><b>Заказчик</b>: <?= $order['name']?></p>
<p><b>Email</b>: <?= $order['email']?></p>
<p><b>Телефон</b>: <?= $order['phone']?></p>
<p><b>Адрес доставки</b>: <?= $order['adress']?></p>
<p><b>Дата размещения заказа</b>: <?= date('d-m-Y H:i', $order['date'])?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Издательство</th>
	<th>Год издания</th>
	<th>ISBN</th>
	<th>Цена, грн.</th>
	<th>Количество</th>
</tr>

<?
	$i = 1;
	foreach($order['products_info'] as $goods){	
?>

<tr>
	<td><?= $i++?></td>
	<td><?= $goods['title']?></td>
	<td><?= $goods['author']?></td>
	<td><?= $goods['publishing']?></td>
	<td><?= $goods['pubyear']?></td>
	<td><?= $goods['isbn']?></td>
	<td><?= $goods['price']?></td>
	<td><?= $goods['count']?></td>
</tr>

<?
	} //end of small foreach
?>
</table>
<p><b>Всего товаров на сумму: </b><?= $order['totalsum']?> грн.</p>
		<form action="" method="post" style="margin-left:570px;">
			<input type="hidden" name="id" value="<?= $order['id']?>">
			<input type="submit" name="del_order" value="Удалить заказ № <?= $order['id']?>" style=" height:30px; padding: 0px 20px;" />
		</form>
<hr>
<?
	} //end of big foreach
}else
	echo "<h1>Заказов нет.</h1>";
?>