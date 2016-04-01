<?
//Error_Reporting(E_ALL & ~E_NOTICE);//не выводить предупреждения об ошибках

define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']); 		//сервер
require_once "./setting_sql.php"; // подключение к БД


function __autoload ($class_name){ //автоматическая загрузка кслассов
	$path=str_replace("_", "/", strtolower($class_name));//разбивает имя класска получая из него путь
	if (file_exists($path.".php")) {
		include_once($path.".php");//подключает php файл по полученному пути	
	}
	else{
		header("HTTP/1.0 404 Not Found");
		echo "К сожалению такой страницы не существует. [".PATH_SITE.$path.".php ]";
		exit;
	}
}

//-------------------------------------
$router=new Lib_Application; //создаем объект, который будет искать нуджные контролеры
$member=$router->Run();//Начинаем поиск нужного контролера

if(isset($member)){ //если контролер вернул какието переменные, то делаеми их доступными для публичной части
	foreach ($member as $key => $value){
		$$key= $value; 
	}
}

/* создаем функционал для всех страниц сайта */
$menu = Lib_Menu::getInstance()->getMenu();
$smal_cart = Lib_SmalCart::getInstance()->getCartData();
$category_list = Lib_Category::getInstance()->getCategoryMenu();


if($_SESSION["Auth"] && $_SESSION["role"]=="1"){ //для админа подключаем панель администратора
		require_once "./admin/template/adminbar.php";
		
		$rout = $router->getRoute();
		if($rout=='orders' || $rout=='categories' || $rout=='products') //если вызывается админка 
			require_once "./admin/template/admin.php";//подключаем ее шаблон
		else
			require_once "./template/index.php";//подключаем шаблон сайта
}
else
	require_once "./template/index.php";//подключаем шаблон сайта 
