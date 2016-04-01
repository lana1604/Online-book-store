<?
class Application_Controllers_Search extends Lib_BaseController
{  
	function __construct(){
		if(isset($_REQUEST['to_search'])){  // если нажата кнопка поиска
			$model = new Application_Models_Search;	//создаем модель
			$data = $_REQUEST;
			$searchgoods = $model->search($data);
			if($searchgoods)
				$this->searchgoods = $searchgoods; //если что-то найдено, делаем доступным для view
			else
				$this->message = "<h1>По вашему запросу ничего не найдено</h1>";
		}
		$allcategories=Lib_Category::getInstance()->categories;
		$this->allcategories  = $allcategories;
	}
}