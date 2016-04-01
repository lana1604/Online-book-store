<table class="card_product">
	<tr>
		<td rowspan="8">
			<image class="card_image" src="/uploads/<?=$product['image_url']?>" alt="<?=$product['title']?>" title="<?=$product['title']?>" />
		</td>
		<td colspan="2"><h1><?=$product['title']?></h1></td>
	</tr>
	<tr>
		<th>Автор:</th>
		<td><?=$product['author']?></td>
	</tr>
	<tr>
		<th>Издательство: </th>
		<td><?=$product['publishing']?></td>
	</tr>
	<tr>
		<th>Год: </th>
		<td><?=$product['pubyear']?>г.</td>
	</tr>
	<tr>
		<th>ISBN: </th>
		<td><?=$product['isbn']?></td>
	</tr>
	<tr>
		<th>Тип обложки: </th>
		<td><?=$product['hardcover']?></td>
	</tr>
	<tr>
		<th>Страниц: </th>
		<td><?=$product['pagecount']?></td>
	</tr>
	<tr>
		<th>
			<div class="product_price"  style="position:static; margin:0;">
				<?=$product['price']?> грн
			</div>
		</th>
		<td>
			<div class="product_buy" style="position:static; margin:0; float:left;">
			<? 
			$buy ='<a href="/catalog?in-cart-product-id='.$product["id"].' ">В корзину</a>';
			echo ($product['presence']? $buy :'Нет на складе');
			?>
			</div>
		</td>
	</tr>
</table>

<h1 style="clear:both;">Аннотация к книге: </h1>
<div class="product_desc"><?=$product['about']?></div>
<br>
