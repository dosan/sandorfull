<?php 
class ProductsModel  extends MainModel{

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
	 * Получаем последние добавленные товары
	 * 
	 * @param integer $limit Лимит товаров
	 * @return array Массив товаров 
	 */
	public function getLastProducts($limit = null){
		$sql =  "SELECT *
			FROM `products`
			ORDER BY `product_id` DESC";
			if ($limit) {
				$sql .= " LIMIT {$limit}";
			}
		$query =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
	/**
	 * Получить данные продукта по ID 
	 * 
	 * @param integer $product_id ID продукта
	 * @return array массив данных продукта 
	 */
	public function getProductById($product_id)
	{
		$product_id = intval($product_id);
		$sql = "SELECT * 
				FROM `products`
				WHERE product_id = '{$product_id}'";
		$query =  $this->querySqlWithTryCatch($sql);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * Получить список продуктов из массива идентификаторов (ID`s)
	 * 
	 * @param array $itemsIds массив идентификаторов продуктов
	 * @return array массив данных продуктов 
	 */
	public function getProductsFromArray($items)
	{
		$productIds = implode($items, ', ');
		$sql = "SELECT * 
				FROM `products`
				WHERE product_id in ({$productIds})";
		$query = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}

	/**
	 * Получить список продуктов из массива идентификаторов (ID`s)
	 * 
	 * @param array $itemsIds массив идентификаторов продуктов
	 * @return array массив данных продуктов 
	 */
	public function getProducts()
	{
		$sql = "SELECT * 
				FROM `products` ORDER BY `product_id` DESC";
		$query = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}

	/**
	 * Добавление нового товара
	 * 
	 * @param string $itemName имя продукта
	 * @param integer $itemPrice цена продукта
	 * @param string $itemDesc описание продукта 
	 * @param integer $itemCat категория продукта 
	 */
	public function insertProduct($itemName, $name_id, $itemPrice, $itemDesc, $itemCat){
		$sql = "INSERT INTO `products`
				SET 
					`product_name` = '{$itemName}',
					`name_id` = '{$name_id}',
					`product_price` = {$itemPrice},
					`product_description` = '{$itemDesc}',
					`cat_id` = {$itemCat}";
		return $this->querySqlWithTryCatch($sql);
	}
	/**
	 * Обновление данных товара
	 * 
	 * @param string $itemId id продукта
	 * @param string $itemName имя продукта
	 * @param integer $itemPrice цена продукта
	 * @param integer $itemSatus status продукта
	 * @param string $itemDesc описание продукта 
	 * @param integer $itemCat категория продукта 
	 * @param integer $newFileName  продукта 
	 */
	public function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = null){
		$set = array();

		$set[] = "`product_status` = '{$itemStatus}'";

		if ($itemName) {
			$set[] = "`product_name` = '{$itemName}'";
		}
		if ($itemPrice > 0) {
			$set[] = "`product_price` = '{$itemPrice}'";
		}
		
		if ($itemDesc) {
			$set[] = "`product_description` = '{$itemDesc}'";
		}
		if ($itemCat) {
			$set[] = "`cat_id` = '{$itemCat}'";
		}
		if ($newFileName) {
			$set[] = "`product_image` = '{$newFileName}'";
		}

		$setStr = implode($set, ', ');

		$sql = "UPDATE `products` SET $setStr WHERE `product_id` = '$itemId'";
		
		return $this->db->exec($sql);
	}
	public function updateProductImage($itemId, $newFileName){
		return $this->updateProduct($itemId, null, null, null, null, null, $newFileName);
	}
}
?>