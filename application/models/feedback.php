<?
class Application_Models_Feedback extends Lib_DateBase // наследует все методы класса для работы с бд
{
	private $fio;
	private $email;
	private $message;
	
	function isValidData($array_data){
		if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['email'])){ 
			$error="E-mail не существует!";	
		} 
		elseif(!trim($array_data['message'])){ 
			$error="Введите текст сообщения!";	
		}
		
		//если нет ошибок, то заносим информацию в поля класса
		if($error)
			return $error;
		else{
			$this->fio=trim($array_data['fio']);
			$this->email=trim($array_data['email']);
			$this->message=trim($array_data['message']);
			return false;
		}		
	}
		
	function sendMail(){
		$to_user  = $this->email; 
		$to_admin = "admin@site.ua";
		$subject = 'Сообщение с формы обратной связи';
		$message = $this->message;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: knizhnyimir@site.ua' . "\r\n";

		if( mail($to_user, $subject, $message, $headers)
			&&
			mail($to_admin, $subject, $message, $headers) )
		  return true;
		else
			return false;
	}
} 