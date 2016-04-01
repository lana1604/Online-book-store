<?
//Модель вывода каталога
class Application_Models_Catalog extends Lib_DateBase
{
	public $category_id; 
	public $current_category=array();

	//получает номер страницы из категории товаров	  
	function getPageList($page=1,$step=9, $admin=false){
		if(!$this->getCurrentCategory()){ 
			echo "Ошибка получения текущей категории!";
			exit; 
		}
		$page=$page-1;
		
		if($this->current_category["url"]=="catalog"){
			$sql = "SELECT  p.id  FROM product p LEFT JOIN category c ON c.id=p.cat_id";
			$result = parent::query($sql);
		}
		else{	//запрос вернет обще кол-во продуктов в выбранной категории
			$sql = "SELECT  p.id  FROM product p LEFT JOIN category c ON c.id=p.cat_id WHERE c.id=%d ";
			$result = parent::query($sql,$this->category_id);
		}

		$count = ceil(mysql_num_rows($result)/$step); // макс кол-во страниц
		if($count == 0)
			return false;
		
		if($page <= 0) $page = 0;
		if($page >= $count) $page = $count-1;
		$lower_bound = $page*$step; // определяем нижнюю границу каталога

 		/* формируем страницу с продуктами */
		if($this->current_category["url"]=="catalog"){
			$sql = "SELECT  c.title as category_title, c.url as category_url, p.url as product_url, p.*  
					FROM product p LEFT JOIN category c ON c.id=p.cat_id  
					ORDER BY id LIMIT %d , %d";
			$result = parent::query($sql,$lower_bound,$step);
		}
		else{
			$sql = "SELECT  c.title as category_title, c.url as category_url, p.url as product_url, p.*
					FROM product p LEFT JOIN category c ON c.id=p.cat_id 
					WHERE c.id=%d ORDER BY id LIMIT %d , %d";
			$result = parent::query($sql,$this->category_id,$lower_bound,$step);	
		}
		if(@mysql_num_rows($result))//если в разделе есть товары то заполняем ими массив
		while ($row = mysql_fetch_assoc($result)){
			$сatalogItems[]=$row;
		}

		/* делаем постраничную навигацию */
		$activ_page=$page; // устанавливаем активную страницу
		$url_page=$this->current_category["url"];// получаем урл секции, если его нет то заменяем на "catalog"

		if($count>1){
			for($page=0; $page<$count; $page++){// перебираем все страницы и формируем ссылки на них
				($activ_page==$page)?$class="activ":$class="";
				if($admin){
					$pages.='<a class="'.$class.'" href="/products?category_id='.$this->category_id.'&p='.($page+1).'">'.($page+1).'</a>';
				}
				else{
					$pages.='<a class="'.$class.'" href="/'.$url_page.'?p='.($page+1).'">'.($page+1).'</a>';
				}
			}
			$pages='<div class="pagination">Страница '.($activ_page+1).' из '.($count).' '.$pages.'</div>';
		}
		
		$сatalogItems['pagination']=$pages;// дописывает  к возвращаемому массиву информацию о пагинации
		return $сatalogItems; 		
	}
	  
	function getCurrentCategory(){
		//получаем ссылку и название текущей категории
		$sql = "SELECT  url, title FROM category WHERE id=%d";
		if($this->category_id){
			$result = parent::query($sql,$this->category_id);
				if($this->current_category = mysql_fetch_assoc($result)){
					return true;
				}
		}
		else{
			$this->current_category['url']="catalog";
			$this->current_category['title']="Каталог";
			return true;	
		}
		return false;
	}
} 