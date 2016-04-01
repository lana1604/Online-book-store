<h2>Корзина</h2>

<?if($empty_cart):?>

		<form action="/cart" method="post">
			<?=$big_cart;?>
			<input type='submit' name='refresh' value='Пересчитать' class="cart_submit" />
			<input type='submit' name='clear' value='Очистить корзину'  class="cart_submit" />
		</form>	

		<form action="/order" method="post">
			<input type="submit" name="order" value="Оформить заказ" class="cart_submit" style=" float:right; height:35px; background:#D47816;" />
		</form>

<?else:?>
<strong>В вашей корзине нет товаров!</strong>
<?endif;?>