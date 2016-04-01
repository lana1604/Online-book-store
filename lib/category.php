<?
//Экземпляр класса может быть вызван лишь один раз.
//Реализован патерн Singleton
class Lib_Category extends Lib_DateBase
{
	public $categories;
	
	protected static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	
	//получаем таблицу категорий из БД, записываем в массив, для дальнейшей работы
	public function __construct() {
		$result = parent::query("SELECT * FROM  `category`");
		if(mysql_num_rows($result)){
			while ($row = mysql_fetch_assoc($result)){
				$this->categories[]=$row; 
			}
		}
	}
	
	public static function getInstance(){ //Возвращает единственный экземпляр класса
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
	}
	 
	public function  addCategory($title){
		$array['title'] = $title;
		$array['url']=$this->translitIt($title);
		
		if(parent::build_query("INSERT INTO category SET ",$array)){
			$message = "Была создана категория '$title'";
		}
		else{
			$message = "Не удалось создать категорию '$title'";
		}
		return $message;
	}
	
	public function  editCategory($id,$old_title,$new_title){
		$array['title'] = $new_title;
		$array['url']=$this->translitIt($new_title);

		if(parent::query("UPDATE category SET ".parent::build_part_query($array)." WHERE id = %d", $id)){
			$message = "Категория '$old_title' была переименована в '$new_title'";
		}
		else{
			$message = "Не удалось переименовать категорию '$old_title'";
		}
		return $message;
	}
	
	public function  delCategory($id, $title){
		if(parent::query("DELETE FROM category WHERE id = %d",$id)){
			$message = "Категория '$title' была удалена";
		}
		else{
			$message = "Не удалось удалить категорию '$title'";
		}
		return $message;
	}
	
	//возвращает список категорий, пригодный для использования в меню.   
	public function  getCategoryMenu(){ 
		foreach($this->categories as $category){
			$print.='<li><a href="/'.$category['url'].'">'.$category['title'].'</a></li>';
		}
		return  $print; 
	}
	
	public function translitIt($str){
		$tr = array(
			"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
			"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
			"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
			"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
			"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
			"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
			"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
			" "=> "_", "."=> "", "/"=> "_","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5",
			"6"=>"6","7"=>"7","8"=>"8","9"=>"9","0"=>"0"
		);
		return strtr($str,$tr);
	}

	function create_url($urlstr){
		if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
			$urlstr = $this->translitIt($urlstr);
			$urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
			return $urlstr;
		}
		return false;
	} 

}