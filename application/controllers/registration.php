<?
class Application_Controllers_Registration extends Lib_BaseController
{  
	function __construct(){
			$this->dislpay_form = true; // показывать форму ввода данных
		if(isset($_REQUEST["send"])){  // если пришли данные с формы
			
			$registration = new Application_Models_Registration;
			
			$array_data['login'] = $_POST['login'];
			$array_data['pass'] = $_POST['pass'];
			$array_data['name'] = $_POST['name'];
			$array_data['phone'] = $_POST['phone'];
			$array_data['email'] = $_POST['email'];
			$array_data['adress'] = $_POST['adress'];
			
			$result=$registration->isValidData($array_data);
			if($result['error'])
				$this->error = $result['error']; // если есть ошибки, заносим их в переменную 
			else{
				$this->result = $result;				
				
				if($registration->registrate($result)){
					header('Location: /registration?thanks=1');
					exit;
				}
				else
					$this->error = "Не удалось зарегестрироваться.";
			}
		}
		
		if($_GET['thanks']){
			$this->message="Регистрация прошла ушпешно!";
			$this->dislpay_form = false;//  форму ввода данных больше не покзываем
		}
	}
}
  