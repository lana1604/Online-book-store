<?
class Lib_Application extends Lib_DateBase //класс маршрутизатор, подбирает нужный контролер для обработки данных
{
	public $route='index';
	public function __construct(){
//		if($_GET['route']!="favicon.ico")
		$this->getRoute();
	}
	
	public function getRoute(){ //получить маршрут .htaccess формирует ссылку таким образом, что в параметры гет запроса попадает требуемый маршрут
		$route=$this->route;
		if (empty($_GET['route'])){
			$route = 'catalog';
		}
		else{
			$route = $_GET['route'];
			$rt=explode('/', $route);
			$route=$rt[(count($rt)-1)]; //берем последний
		
			/*проверим не к продукту ли из каталога пытается обратиться пользователь
			если есть предпоследний (например category из category/product),
			то будем искать полученный в каталоге id продукта по запрашиваемой ссылке*/
			
			if(isset($rt[(count($rt)-2)])){
				$sql = "SELECT  c.url as category_url, p.url as product_url, p.id  FROM product p LEFT JOIN category c ON c.id=p.cat_id WHERE p.url like '$route'";
				$result = parent::query($sql);

				if($obj = mysql_fetch_object($result)){
					if($rt[(count($rt)-2)]==$obj->category_url){
						$sql = "SELECT  p.id  FROM product p WHERE p.url like '%s'";
						$result = parent::query($sql,$route);
						if($row = mysql_fetch_object($result)){
							$_REQUEST['id']=$row->id;
							$route="product";
						}
					}
				}
			}
			else{
				$sql = "SELECT  c.url as category_url, c.id FROM category c WHERE c.url like '%s'";
				$result = parent::query($sql,$route);
				if($obj = @mysql_fetch_object($result)){
					$_REQUEST['category_id']=$obj->id;
					$route="catalog";
				}
			}
		}
		$this->route=$route;
		return $route;
	}

	private function getController(){//получить контролер  
		$route=$this->route;
		if($route=="orders" || $route=="categories" || $route=="products"){
			$path_contr = 'admin/controllers/';
			$controller= $path_contr. $route . '.php';
		}
		else{
			$path_contr = 'application/controllers/';
			$controller= $path_contr. $route . '.php';
		}
		return $controller;
	}
	 
	public function getView(){ //получить представление для контролера
		$route=$this->route;
		if($route=="orders" || $route=="categories" || $route=="products"){
			$path_view = 'admin/views/' ;
			$view = $path_view . $route . '.php';
		}
		else{
			$path_view = 'application/views/' ;
			$view = $path_view . $route . '.php';
		}
		return $view;
	}
	 
	public function Run(){ 
		session_start(); //открываем сессию
		$controller=$this->getController();//получаем контролер
		$cl=explode('.', $controller);
		
		$cl=$cl[0]; //отбрасываем расширение, получаем только путь до контролера
		$name_contr=str_replace("/", "_", $cl);//заменяем в пути слеши на подчеркивания,
												//таким образом получая название класса
		
		$contr=new $name_contr;//создаем экземпляр класса контролера
		$member=$contr->member;//получаем переменные контролера
		return $member;
	}
}
