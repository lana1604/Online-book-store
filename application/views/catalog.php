<h1>
	<?=$TiteCategory?><br>
	<?= $message?>
</h1> 

<?
if($Items){
	foreach($Items as $item){
		if($i%3==0){
?> 
			<div style="clear:both;"></div>
		<? } ?>
	<div class="product">
		<div class="product_image">
			<a href="/<?=$item["category_url"]?>/<?=$item["product_url"]?>"><image src="/uploads/<?=$item["image_url"]?>" /></a>
		</div>
		<div>
			<?=$item["author"]?><br>
			<b><?=$item["title"]?></b>		
		</div>
		<a class="more" href="/<?=$item["category_url"]?>/<?=$item["product_url"]?>">Подробнее...</a>
		<div class="product_price"><?=$item["price"]?> грн.</div>
		<div class="product_buy">
<? 
$buy ='<a href="/catalog?in-cart-product-id='.$item["id"].' ">В корзину</a>';
echo ($item['presence']? $buy :'Нет на складе');
?>
		</div>
	</div>
<?	$i++;
	} // end if
} // end foreach
	echo $pagination;
?>

