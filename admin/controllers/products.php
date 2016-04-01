<?
class Admin_Controllers_Products extends Lib_BaseController
{
	function __construct(){
		$model_product=new Application_Models_Product;
		
		$this->dislpay_form = false; // не показывать форму для добавления/редактирования товара

		if($_GET['add_product']){
			$this->dislpay_form = true;			
			if($_POST['save_product']){		
				$product['title'] = $_POST['title'];
				$product['url']= $model_product->translitIt($product['title']);
				$product['author'] = $_POST['author'];
				$product['publishing'] = $_POST['publishing'];
				$product['pubyear'] = $_POST['pubyear'];
				$product['isbn'] = $_POST['isbn'];
				$product['hardcover'] = $_POST['hardcover'];
				$product['pagecount'] = $_POST['pagecount'];
				$product['price'] = $_POST['price'];
				$product['presence'] = ($_POST['presence']?1:0);
				$product['about'] = $_POST['about'];
				$product['cat_id'] = $_POST['cat_id'];
				
				if($message = $model_product->EmptyField($product)){ 
					$this->message = $message;		//если вернет сообщение, то есть пустые поля
				}
				else{		//если все поля заполнены
					$actual_image_name = $product['url'];/////////////////////////////////////////////
					$default_image_url = 'none.jpg';
					
					$result = $model_product->loadImage($actual_image_name, $default_image_url);
					$product['image_url'] = $result['actual_image_name'];
					if(isset($result['error_message']))  //только в случае проблем с файлом
						$this->load_message = $result['error_message']; 
					
					$this->message = $model_product->addProduct($product);//отчет о добавлении товара
					$this->dislpay_form = false;
				}
			}
		}

		if($_GET['edit_product']){
			$this->dislpay_form = true;
			$id = $_GET['id'];
			$this->product = $model_product->getProduct($id);
			
			if($_POST['save_product']){		
				$product['title'] = $_POST['title'];
				$product['url']= $model_product->translitIt($product['title']);
				$product['author'] = $_POST['author'];
				$product['publishing'] = $_POST['publishing'];
				$product['pubyear'] = $_POST['pubyear'];
				$product['isbn'] = $_POST['isbn'];
				$product['hardcover'] = $_POST['hardcover'];
				$product['pagecount'] = $_POST['pagecount'];
				$product['price'] = $_POST['price'];
				$product['presence'] = ($_POST['presence']?1:0);
				$product['about'] = $_POST['about'];
				$product['cat_id'] = $_POST['cat_id'];
				
				if($message = $model_product->EmptyField($product)){ 
					$this->message = $message;		//если вернет сообщение, то есть пустые поля
				}
				else{		//если все поля заполнены
					$actual_image_name = $product['url'];
					$default_image_url = $_GET['image_url'];
					
					$result = $model_product->loadImage($actual_image_name, $default_image_url);
					$product['image_url'] = $result['actual_image_name'];
					if(isset($result['error_message']))  //только в случае проблем с файлом
						$this->load_message = $result['error_message']; 
					
					$this->message = $model_product->editProduct($product,$id);//отчет о изменении товара
					$this->dislpay_form = false;
				}
			}
		} //edit_product
		
		if($_GET['del_product']){
			$id = $_GET['id'];
			$this->message = $model_product->delProduct($id);
		}
		
		$model=new Application_Models_Catalog;	
		$catalog=array();
		
		if($_GET['select_category']){
			$model->category_id = $_GET['category_id'];
		}
		
		$page = $_GET['p'];
		if($catalog = $model->getPageList($page,5,true)){
			$this->pagination  = $catalog['pagination'];
			unset($catalog['pagination']);
			$this->catalog  = $catalog;
		}
		else{
			$this->message = "В этой категории пока нет товаров!";
		}
		
		$allcategories=Lib_Category::getInstance()->categories;
		$this->allcategories  = $allcategories;
	}
}