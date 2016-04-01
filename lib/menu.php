<?
//класс меню, возвращает html код для меню. 
class Lib_Menu
{
	public $MenuItem = array("Каталог"=>"/catalog", "Доставка и оплата"=>"/payment", "О нас"=>"/about", "Обратная связь"=>"/feedback", "Регистрация"=>"/registration", "Авторизация"=>"/authorization");

	protected static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	private function __construct() {}	
	public static function getInstance() {//Возвращает единственный экземпляр класса
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
	}
	 
	public function  getMenu(){
		$print="<ul>";	 
		foreach($this->MenuItem as $name=>$item ){
			if($name=="Авторизация" && $_SESSION["User"]!=""){  //Для авторизированного показываем логин и "выйти"
				$print.='<li>'.$_SESSION["User"].'<a href="/authorization?out=1">
						<span style="font-size:10px">[ выйти ]</span></a></li>';
			}
			else $print.='<li><a href="'.$item.'">'.$name.'</a></li>';
		}
		$print.="</ul>";
		return  $print; 
	}
}
