<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/template/style.css" type="text/css" />

</head>
<body>
	<div id="wrapper">
		<div id="header">
	
			
			<div class="search">
				<form action="/search" method="post">
					<p><input name="phrase" placeholder="Поиск..." size="50" />
					<input class="sub_search" type="submit" name="to_search" value="Найти" />
					<input type="hidden" name="rule" value="any" /><br>
					<a href="/search" >Расширенный поиск</a></p>
				</form>
			</div>
			
			<div class="logo">
			<a href="/"><img src="/images/logo.png" height="100%"/></a>
			</div>
			
			<div class="smalcart">
						
				<strong>Товаров в корзине:</strong>	<?=$smal_cart['cart_count']?> шт.
				<br/>
				<strong>На сумму:</strong>	<?=$smal_cart['cart_price']?> грн.	
				<br/>
				<a href='/cart'>Перейти в корзину</a>
			
			</div>	
			
			<div class="menu">
				<?=$menu?>  <!-- получаем из function.php -->
			</div>	

		</div>
		
		<div id="sidebar">
		<div class="sidebarmenu">
			<ul id="sidebarmenu1">
				<?=$category_list?>  <!-- получаем из function.php -->
			</ul>
		</div>
		</div>	
		<div id="content">
		
		