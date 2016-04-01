<?
class Application_Models_Registration extends Lib_DateBase // наследует все методы класса для работы с бд
{
	function isValidData($array_data){
		foreach($array_data as $name => $value){
			if(!trim($value)) 
				$result['error'] = "Вы заполнили не все поля!";
			else
				$result["$name"] = $value;
		}
		if(!$result['error']){ 	//Если все поля заполнены проверяем email
			if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['email'])){ 
					$result['error'] = "E-mail не корректный!";
			}
			if($res = parent::query("SELECT login FROM user WHERE login='%s'",$array_data['login'])){
				if(mysql_num_rows($res) != 0)
					$result['error'] = "Пользователь с таким логином уже есть!";
			}
		}
		return $result;
	}

	function registrate($array){
		if(parent::build_query("INSERT INTO `user` SET ",$array))
			return true;
		else
			return false;
	}
} 