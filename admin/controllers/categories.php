<?
class Admin_Controllers_Categories extends Lib_BaseController
{
	function __construct()
	{
		$model = new Lib_Category;
		if(isset($_POST['add_category'])){  // если нажата кнопка "добавить категорию"
			if(!empty($_POST['name_category'])){
				$title = $_POST['name_category'];
				$message = $model->addCategory($title);
				//header("Location: /categories?message=".$message);
			}
			else
				$message = "Вы не ввели имя категории!";
			header("Location: /categories?message=".$message);
		}

		if(isset($_POST['edit_category'])){  // если нажата кнопка сохранения изменений
			if(!empty($_POST['new_title'])){
				$id = $_POST['cat_id'];
				$old_title = $_POST['old_title'];
				$new_title = $_POST['new_title'];
				$message = $model->editCategory($id,$old_title,$new_title);
				//header("Location: /categories?message=".$message);
			}
			else
				$message = "Имя категории не может быть пустым!";
			header("Location: /categories?message=".$message);
		}

		if(isset($_POST['del_category'])){  // если нажата кнопка "Удалить категорию"
			$id = $_POST['cat_id'];
			$title = $_POST['old_title'];
			
			$message = $model->delCategory($id, $title);
			header("Location: /categories?message=".$message);
		}

		if($_GET['message']){
			$this->message = $_GET['message'];
		}
		
		$this->categories=$model->categories;	 
	}
}