<?php


class CategoriesModel extends MainModel{
	/**
	 * Получить главные категории с привязками дочерних
	 * 
	 * @return array массив категорий 
	 */

	public function getAllMainCatsWithChildren(){
		$sql = 
			"SELECT
				cat_id,
				parent_id,
				cat_name,
				cat_description
			FROM
				`shop_categories`
			WHERE
				parent_id = 0
			";
		$query =  $this->querySqlWithTryCatch($sql);
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$rsChildren = $this->getChildrenCategories($row['cat_id']);
			if ($rsChildren) {
				$row['children'] = $rsChildren;
			}
			$result[] = $row;
		}
		return $result;
	}

	 /**
	 * Получить дочернии категории для категории $cat_id
	 * 
	 * @param integer $cat_id ID категории
	 * @return array массив дочерних категорий 
	 */
	public function getChildrenCategories($cat_id){
		$sql = 
			"SELECT
				cat_id,
				parent_id,
				cat_name,
				cat_description
			FROM
				`shop_categories`
			WHERE
				parent_id = '{$cat_id}'";
		$query =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
	/**
	 * Получить данные категории по id
	 * 
	 * @param integer $cat_id ID категории
	 * @return array массив - строка категории 
	 */
	public function getCategoryRecordsById($cat_id){
		$sql = 
			"SELECT
				*
			FROM
				`shop_categories`
			WHERE
				cat_id = '{$cat_id}'";
		$query =  $this->querySqlWithTryCatch($sql);
		$categories = $query->fetch(PDO::FETCH_ASSOC);
		return $categories;
	}

	/**
	 * Получить продукты для категории $cat_id
	 * 
	 * @param integer $cat_id ID категории
	 * @return array массив продуктов 
	*/
	public function getProductsByCat($cat_id){
		$sql =  "SELECT *
			FROM `products`
			WHERE
				cat_id = '{$cat_id}'";
		$query =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
	/**
	* get all main categories
	*
	* @return array data catogries
	*/
	public function getAllMainCategories(){
		$sql = "SELECT *
			FROM shop_categories
			WHERE parent_id = 0
			";
		$result = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}
	/**
	* Add the new category
	* @param string $cat_name Name of category
	* @param integer $cat_parent_id ID parent category
	* @return integer ID new category
	*/
	public function insertCategory($cat_name, $cat_parent_id = 0){
		$cat_url = get_in_translate_to_en($cat_name);
		// prepare query
		$sql = "INSERT INTO
					`shop_categories`(`parent_id`, `cat_name`, `cat_url`)
				VALUES ({$cat_parent_id}, '{$cat_name}', '{$cat_url}')";

		$result = $this->querySqlWithTryCatch($sql);
		$cat_id = $this->db->lastInsertId();
		return $cat_id;
	}
	/**
	* Get All categories
	*
	* @return array categories
	*/
	public function getAllCategories(){
			$sql = "SELECT *
			FROM shop_categories
			ORDER BY parent_id ASC";

		$result = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}

	/**
	* Update Categories
	*
	* @param integer $item_id category id
	* @param integer $parent_id id main category
	* @param string $new_name new name category
	*
	*/
	public function updateCategoryData($item_id, $parent_id = -1, $new_name = ''){
		$set = array();
		if ($new_name) {
			$set[] = "`cat_name` = '{$new_name}'";
		}
		if ($parent_id > -1) {
			$set[] = "`parent_id` = {$parent_id}";
		}
		$setStr = implode($set, ", ");
		$sql = "UPDATE `shop_categories` SET $setStr WHERE cat_id = '{$item_id}'";
		$result = $this->querySqlWithTryCatch($sql);
		return $result;
	}


}//endclass