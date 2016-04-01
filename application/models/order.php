<?
//Модель оформления заказа
class Application_Models_Order extends Lib_DateBase // наследует все методы класса для работы с бд
{
	private $name;
	private $email;
	private $phone;
	private $adress;
	
	function isValidData($array_data){
		if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['email'])){ 
			$error="E-mail не существует!";	
		} 
		elseif(!trim($array_data['adress'])){ 
			$error="Введите адресс!";	
		}
		
		if($error)
			return $error;
		else{
			$this->name=trim($array_data['name']);
			$this->email=trim($array_data['email']);
			$this->phone=trim($array_data['phone']);
			$this->adress=trim($array_data['adress']);
			return false;
		}     
	}
	
	function readData($login){
		$user = parent::query("SELECT name, adress, phone, email FROM user WHERE login='%s'",$login);
		$user_data = mysql_fetch_array($user, MYSQL_ASSOC);
		return $user_data;
	}
		
	function addOrder(){
		$date = mktime(); //текущая дата в UNIX формате
		$item_position = new Application_Models_Product();
		//добавляем в массив корзины третий параметр  цены товара, для сохранения в заказ
		// это нужно для того чтобы в последствии вывести детальную информацию о заказе. 
		//Если оставить только id то информация может оказаться не верной, так как цены меняются.
		ob_start();
		foreach($_SESSION['cart'] as $product_id=>$count){
			$price=$item_position->getProductPrice($product_id);
			$product_positions[$product_id] = array("price"=>$price, "count"=>$count);
		}
		
		// сериализуем данные в строку для записи в бд
		$order_content=addslashes(serialize($product_positions));
		// создаем новую модель корзины чтобы узнать сумму заказа
		$cart = new Application_Models_Cart();	
		$summ = $cart->getTotalSumm();
		
		//формируем массив параметров SQL запроса
		$array=array(
			"name"=>$this->name, 
			"email"=>$this->email,
			"phone"=>$this->phone,
			"adress"=>$this->adress,
			"date"=>$date,
			"totalsum"=>$summ,
			"order_content"=>$order_content
		);
		
		// отдаем на обработку  родительской функции build_query
		parent::build_query("INSERT INTO `orders` SET",$array);
		$id=mysql_insert_id(); //заказ номер id добавлен в базу
		
		if($id) $cart->clearCart();// если заказ успешно записан, то отчищаем корзину
		return $id; // возвращаем номер заказа
	}

	function getOrders(){
		$result = parent::query("SELECT * FROM orders");
		
		while ($order = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
			// создаёт PHP-значение из хранимого в строке представления
			$product_positions = unserialize(stripslashes($order["order_content"])); 
			
			foreach($product_positions as $product_id => $product){
				$res = parent::query("SELECT * FROM product p WHERE p.id = %d", $product_id);
				$product_info = mysql_fetch_assoc($res);
				$product_info["price"] = $product["price"]; // меняем текущую цену на ту, что была на момент оформления заказа
				$product_info["count"] = $product["count"]; // количество едениц товара
				$products_info[] = $product_info;
			}
			$order["products_info"] = $products_info;
			unset($products_info); //очистить для следующего заказа
			
			$allorders[] = $order;
		}
		return $allorders;
	}
	
	function  delOrder($id){
		if(parent::query("DELETE FROM orders WHERE id = %d",$id))
			$message = "Заказ № $id был удален!";
		else
			$message = "Заказ № $id не удалось удалить!";
		
		return	$message;
	}
  } 
