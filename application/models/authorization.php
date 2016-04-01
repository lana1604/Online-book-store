<?
class Application_Models_Authorization extends Lib_DateBase
{
	function authorize($login,$pass)
	{
		$sql = parent::query("SELECT * FROM `user` WHERE login='%s' and pass='%s'",$login,$pass);
		if( mysql_num_rows($sql)!=0){ //если в базе есть совпадение
			$row=mysql_fetch_assoc($sql);
			$_SESSION["Auth"]=true;
			$_SESSION["User"]=$login;
			$_SESSION["role"]=$row["role"];
			return true;
		} 
		else{
			$_SESSION["Auth"]=false;
			return false;
		}
	}
}
