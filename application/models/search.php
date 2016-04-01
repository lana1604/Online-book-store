<?
 class Application_Models_Search extends Lib_DateBase 
{
	function search($array){
		if($array['cat_id'] != 0){
			$part_query_category = sprintf("cat_id='%d' AND ", mysql_real_escape_string($array['cat_id']));
		}
		if(!empty($array['phrase'])){	//если введено название книги
			if($array['rule'] == 'exact'){ //правило "точная фраза"
				$word = '%'.$array['phrase'].'%';
				$part_query_phrase = sprintf("title LIKE '%s' AND ", mysql_real_escape_string($word));
			}
			else{	//для правила "любое из слов"
				preg_match_all('/\S+/i', $array['phrase'], $out); //разбиваем на слова
				$query_phrase ='';
				for($i = 0; isset($out[0][$i]); $i++){ //проходим по получившемуся массиву слов 
					$word = $out[0][$i];
					$word = '%'.$word.'%';
					$query_phrase .= sprintf("title LIKE '%s' OR ", mysql_real_escape_string($word));
				}
				$query_phrase = trim($query_phrase, ' OR ');
				$part_query_phrase = "($query_phrase) AND ";
			}
		}
		if(!empty($array['minprice'])){
			$part_query_minprice = sprintf("price >= '%f' AND ", mysql_real_escape_string($array['minprice']));
		}
		if(!empty($array['maxprice'])){
			$part_query_maxprice = sprintf("price <= '%f' AND ", mysql_real_escape_string($array['maxprice']));
		}
		/*  ОСТАВШИЕСЯ ПАРАМЕТРЫ  */
		if(!empty($array['author'])){
			$author = '%'.$array['author'].'%';
			$part_query_author = sprintf("author LIKE '%s' AND ", mysql_real_escape_string($author));
		}
		if(!empty($array['publishing'])){
			$values['publishing'] = $array['publishing'];
		}
		if(!empty($array['pubyear'])){
			$values['pubyear'] = $array['pubyear'];
		}
		if(!empty($array['isbn'])){
			$values['isbn'] = $array['isbn'];
		}
		if($values){	// если были введены издательство/год/isbn
			$part_query_other = parent::build_part_query($values, ' AND ');
		}
		
		$part_query = $part_query_phrase.$part_query_author.$part_query_category.$part_query_other.$part_query_minprice.$part_query_maxprice;
		
		if(empty($part_query)){	//если пустая, то пользователь ничего не ввел
			return false;
		}
		
		$sql = "SELECT * FROM product WHERE ".$part_query;
		$sql = trim($sql, " AND ");
		
		$result = parent::query($sql);
		
		if(mysql_num_rows($result) == 0){	//если ничего не нашлось
			return false;
		}
		
		while ($searchgood = mysql_fetch_assoc($result)){
			$sql = sprintf("SELECT url FROM category WHERE id='%s'", mysql_real_escape_string($searchgood['cat_id']));
			$res = parent::query($sql);
			$searchgood['category_url'] = mysql_fetch_assoc($res);
			$searchgoods[] = $searchgood;
		}
		
		return $searchgoods;
	}
}
