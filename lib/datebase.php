<?
class Lib_DateBase {
	private static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	
	public static function getInstance() {//Возвращает единственный экземпляр класса
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
	}
	 
	function query($query){
		if(($num_args = func_num_args()) > 1){  //количество аргументов, переданных функции
			$arg  = func_get_args();
			unset($arg[0]); //Первый элемент массива args содержал текст sql запроса, его проверять не нужно
			
			foreach($arg as $argument=>$value){
				$arg[$argument]=mysql_real_escape_string($value); 
			}
			$query = vsprintf($query,$arg);	//Возвращает отформатированную строку, подставляя $arg в $query
		}
		$result = mysql_query($query);
		if($result)
			return $result;
		return false;	
	}
	
	function build_query($query,$array,$_devide = ','){
		if(is_array($array)){
			$part_query = '';
			foreach($array as $index=>$value){
				$part_query .= sprintf(" `%s` = '%s'".$_devide,$index,mysql_real_escape_string($value));
			}
			$part_query = trim($part_query,$_devide);
			$query.=$part_query;
			return $this->query($query);
		}
		return false;
	}
	
	function build_part_query($array, $_devide = ','){
		$part_query="";
		if(is_array($array)){
			$part_query = '';
			foreach($array as $name=>$value){
				$part_query .= sprintf(" `%s` = '%s'".$_devide,$name,mysql_real_escape_string($value));
			}
			$part_query = trim($part_query,$_devide);
		}
		return $part_query;
	}
}