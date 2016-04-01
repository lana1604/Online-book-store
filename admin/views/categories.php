<?
if($message) echo "<h1>$message</h1>";
?>

<form action="" method="post">
	<input type="text" name="name_category" value="" />&nbsp;
	<input type="submit" name="add_category" value="Добавить категорию" />
</form>
<br>
<table border="1" cellpadding="5" cellspacing="0" style="width:550; background: #F9F4D7;">
	<tr>
		<th>ID</th>
		<th>Название категории</th>
		<th>Редактировать</th>
		<th>Удалить</th>
	</tr>
<?
foreach($categories as $category) {
?>
	<tr>
		<form action="" method="post">
			<input type="hidden" name="cat_id" value="<?= $category['id']?>">
			<input type="hidden" name="old_title" value="<?= $category['title']?>">
		<td><?= $category['id']?>&nbsp;</td>
		<td><input type="text" name="new_title" value="<?= $category['title']?>" />&nbsp;</td>
		<td><input type="submit" name="edit_category" value="Сохранить" />&nbsp;</td>
		<td><input type="submit" name="del_category" value="Удалить" /></td>
		</form>
	</tr>
<?
} //end foreach
?>
</table>
