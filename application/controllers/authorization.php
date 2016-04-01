<?
class Application_Controllers_Authorization extends Lib_BaseController
{
	function __construct(){
		$this->dislpay_form = true; // показывать форму ввода данных
		if(isset($_REQUEST["send"])){  // если пришли данные с формы
			$authorization = new Application_Models_Authorization;

			$login = $_POST['login'];
			$pass = $_POST['pass'];

			if($authorization->authorize($login,$pass)){ //если вернуло true
				header('Location: /authorization?thanks=1');
				exit;
			}
			else
				$this->message="Данные введены не верно!";
		}
		if($_GET['thanks']){
			$this->message="Авторизация прошла успешно!";
			$this->dislpay_form = false;//  форму ввода данных больше не покзываем
		}
		if($_GET['out']=="1"){
			$_SESSION["Auth"]=false;
			$_SESSION["User"]="";
			$_SESSION["role"]="";
			$this->dislpay_form = true;
		}
	}
}
 