<?
//контролер обрабатывает данные каталога
class Application_Controllers_Catalog extends Lib_BaseController
{
	function __construct(){
		 if($_REQUEST['in-cart-product-id']){ // если нажата кнопка купить
			$cart=new Application_Models_Cart;
			$cart->addToCart($_REQUEST['in-cart-product-id']);
			Lib_SmalCart::getInstance()->setCartData();
			header('Location: /catalog');
			exit;
		}
		$model=new Application_Models_Catalog; 
		$model->category_id=$_REQUEST['category_id'];

		$page = $_GET['p'];
		if($Items = $model->getPageList($page,6)){
			$this->pagination  = $Items['pagination'];
			unset($Items['pagination']);
			$this->Items=$Items;
		}
		else{
			$this->message = "В этой категории пока нет товаров!";
		}
		$this->TiteCategory=$model->current_category["title"];
	}
}