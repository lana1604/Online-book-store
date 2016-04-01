<br>
<form action="" name="search_form" method="get">
	<table border="1"  class="table_form" width="95%"> 
		<tr>
			<th>Искать в названии</th>
			<td>
				<select name="rule">
					<option  value="any">Любое из этих слов</option>
					<option  value="exact">Точная фраза</option>
				</select>&nbsp;
				<input type="text" name="phrase" size="45" value="<?=$_REQUEST['phrase']?>"/>
			</td>
		</tr>
		<tr>
			<th>Искать в категории</th>
			<td>
				<select	name="cat_id">
					<option	value="0" >- Все категории -</option>
					<? foreach($allcategories as $category){ ?>
					<option	value="<?= $category['id']?>"><?= $category['title']?></option>		
					<? } ?>
				</select>
			</td>			
		</tr>
		<tr>
			<th>Автор:</th>
			<td>
				<input type="text" name="author" value="<?=$_REQUEST['author']?>" size="70px"/>
			</td>
		</tr>
		<tr>
			<th>Издательство:</th>
			<td>
				<input type="text" name="publishing" value="<?=$_REQUEST['publishing']?>" size="70px"/>
			</td>
		</tr>
		<tr>
			<th>Год:</th>
			<td>
				<input type="text" name="pubyear" value="<?=$_REQUEST['pubyear']?>" size="70px"/>
			</td>
		</tr>
		<tr>
			<th>ISBN:</th>
			<td>
				<input type="text" name="isbn" value="<?=$_REQUEST['isbn']?>" size="70px"/>
			</td>
		</tr>
		<tr>
			<th>Поиск по цене(грн.)</th>
			<td>
				<input type="text" name="minprice" value="<?=$_REQUEST['minprice']?>" size="15" />&nbsp;-&nbsp;
				<input type="text" name="maxprice" value="<?=$_REQUEST['maxprice']?>" size="15" />
			</td>
		</tr>
	</table>
	<input type="submit" class="table_submit" style="width:100px; margin:10px 50px" name="to_search" value="Найти"/>	
	<input type="reset" class="table_submit" style="margin:10px" name="reset" value="Очистить форму"/>
</form>

<br><br>
<? if($searchgoods){ ?>

<h2>Результаты поиска:</h2>
<?
	foreach($searchgoods as $searchgood){
?>
<table id="found">
	<tr colspan="2">
		<a href="/<?=$searchgood["category_url"]?>/<?=$searchgood["url"]?>">
					<?= $searchgood["author"]?> <?= $searchgood["title"]?></a>
	</tr>
	<tr style="vertical-align: top">
		<td rowspan="2">
			<image class="found_img" src="/uploads/<?=$searchgood["image_url"]?>"/>
		</td>
		<td>
			<div width="100%"><?= $searchgood["about"]?></div><br>
		</td>
	</tr>
	<tr style="vertical-align: bottom">
		<td>
			<div class="found_price">Цена: <?= $searchgood["price"]?> грн.</div>
<? 
$buy ='<a href="/catalog?in-cart-product-id='.$searchgood["id"].' ">В корзину</a>';
?>
			<div class="found_buy">
			<?=($searchgood['presence']? $buy :'<b>Нет на складе</b>')?>
			</div>
		</td>
	</tr>
</table>
<hr>
<?
	} // end foreach
} // end if
	echo $message;
?>
