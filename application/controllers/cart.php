<?
class Application_Controllers_Cart extends Lib_BaseController
{
	function __construct(){
		$model=new Application_Models_Cart;	
		if($_REQUEST['refresh']){ // если пользователь изменил данные в корзине
			$list_Item_Id=$_REQUEST;
			
			/* пробегаем по массиву , находим пометки на удаление и на изменение количества */
			foreach($list_Item_Id as $Item_Id => $new_count){
				$id="";
				if(substr($Item_Id, 0, 5)=="item_") {
					$id=substr($Item_Id, 5);
					$count=$new_count;
				}
				elseif(substr($Item_Id, 0, 4)=="del_"){
					$id=substr($Item_Id, 4);
					$count=0;
				}
				if($id){
					$array_product_id[$id]=(int)$count;					
				} 
			}
			$model->refreshCart($array_product_id); // передаем в модель данные для обновления корзины
			Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
			header('Location: /cart');
			exit;
		}
		if($_REQUEST['clear']){ // если пользователь хочет очистить корзину
			$model->clearCart(); // передаем в модель данные для обновления корзины
			Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
			header('Location: /cart');
			exit;
		}
		$big_cart=$model->printCart(); //выводим список позиций к заказу()
		$this->big_cart=$big_cart; //в представлении он будет доступен через переменную $big_cart
		$this->empty_cart=$model->isEmptyCart();
	}
}
