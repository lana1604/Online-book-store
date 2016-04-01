<?
//любой контролер будет наследоваться от Lib_BaseController
class Lib_BaseController 
{
	private $member; 
	
	function __set($name,$val){
		$this->member[$name] = $val;
	}
	
	function __get($name){
		return $this->member;
	} 
}
