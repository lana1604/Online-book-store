<?
class Application_Models_Product extends Lib_DateBase
{
	public function EmptyField($array){
		foreach($array as $key => $value){
			if(empty($value) && $key!='presence'){
				$message = "Вы заполнили не все поля.";
				return $message;
			}
		}
		return false;
	}

	public function  addProduct($array){
		if(parent::build_query("INSERT INTO product SET ",$array)){
			$id = mysql_insert_id();
			$message = "Был создан товар с id = $id";
		}
		else{
			$message = "Не удалось создать товар";
		}
		return $message;
	}
	
	public function editProduct($array,$id){
		if(parent::query("UPDATE product SET ".parent::build_part_query($array)." WHERE id = %d",$id)){  
			$message = "Был изменен товар с id = $id";
		}
		else{
			$message = "Не удалось изменить товар с id = $id";
		}
		return $message;
	}
	  
	public function delProduct($id){
		if(parent::query("DELETE FROM product WHERE id = %d",$id)){
			$message = "Был удален товар с id = $id";
		}
		else{
			$message = "Не удалось удалить товар с id = $id";
		}
		return $message;
	}
	  
	public function getProduct($id){
		 $result=parent::query("SELECT * FROM product WHERE id='%d'",$id);
		 if($product = mysql_fetch_array($result)) 
		 return $product; 
	}

	public function getProductPrice($id){
		$sql = sprintf("SELECT price FROM product WHERE id='%d'", mysql_real_escape_string($id));
		$result = parent::query($sql);
		if($row = mysql_fetch_object($result)){
			 return $row->price; 
		}
		return false; 
	}

	public function loadImage($actual_image_name, $default_image_url)
	{
		$path = "./uploads/";
		$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg");
		
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		$tmp = $_FILES['photoimg']['tmp_name'];
			
		if(strlen($name)){
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats)){
				if($size<(1024*1024)){
					$actual_image_name = $actual_image_name.".".$ext;
					if(move_uploaded_file($tmp, $path.$actual_image_name)){
						$result['actual_image_name'] = $actual_image_name;
					}
					else{
						$result['actual_image_name'] = $default_image_url;
						$result['error_message'] = "Не удалось загрузить изображение";
					}
				}
				else{
					$result['actual_image_name'] = $default_image_url;
					$result['error_message'] = "Размер изображения больше 1 МБ";
				}
			}
			else{
				$result['actual_image_name'] = $default_image_url;
				$result['error_message'] = "Формат изображения не поддерживается";
			}
		}
		else{
			$result['actual_image_name'] = $default_image_url;
		}
		return $result;
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
} 
 