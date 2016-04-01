<?
class Admin_Controllers_Orders extends Lib_BaseController
{
	function __construct(){
		$model = new Application_Models_Order;
		if($_POST['del_order']){
			$id = $_POST['id'];
			$this->message = $model->delOrder($id);
		}
		$this->orders=$model->getOrders();
	}
}
