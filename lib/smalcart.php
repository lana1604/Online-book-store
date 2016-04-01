<?
//Клас моделирует маленькую корзину
class Lib_SmalCart
{
	protected static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	private function __construct() {}	
	public static function getInstance(){ //Возвращает единственный экземпляр класса
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
	}
	
	public function  setCartData(){ // записывает в cokie текущее состояние корзины в сериализованном виде
		$cart_content = serialize($_SESSION['cart']); // сериализует  данные корзины из сессии в строку
		SetCookie("cart", $cart_content,time()+3600*24*365); //записывает сериализованную строку в куки, хранит 1 год
	}
	
	protected function  getCokieCart()// получить данные из куков назад в сессию
	{
		if(isset($_COOKIE)){ // если куки существуют	
			$_SESSION['cart']=unserialize(stripslashes($_COOKIE['cart'])); //десериализует строку в массив
			return  true;	
		}
		return  false; 
	}
	
	/* Получает данные из БД (цены) и вычисляет общую стоимость содержимого, а также количество */
	public function getCartData(){ 
	 	$res['cart_count']=0; //количество вещей в корзине
		$res['cart_price']=0; //общая стоимость
		if($this->getCokieCart() && $_SESSION['cart']){ //если удалось получить данные из куков и они успешно десериализованы в $_SESSION['cart']
			foreach ($_SESSION['cart'] as $id=>$count){ // пробегаем по содержимому, вычилсяя сумму и количество
				$sql = "SELECT p.price FROM product p WHERE id='{$id}'";
				$result = mysql_query($sql)  or die(mysql_error());
				if($row = mysql_fetch_assoc($result)) {
					$total_price+=$row['price']*$count;
					$total_count+=$count;
				}	 
			}
			$res['cart_count']=$total_count;
			$res['cart_price']=$total_price;
		}
		return  $res;
	}
}
