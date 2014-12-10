<?php


class OrdersModel extends MainModel{

	/**
	* Модель для таблицы заказов (orders)
	* 
	*/

	/**
	* Создание заказа (без привязки товара)
	* 
	* @param string $user_name
	* @param string $user_phone
	* @param string $user_adress
	* @return integer ID созданного заказа 
	*/
	function makeNewOrder($user_name, $user_phone, $user_adress)
	{
		//> инициализация переменных
		$user_id = $this->getSession('user_id');
		$comment	=	"id пользователя:  {$user_id} <br />
						Имя: {$user_name} <br />
						Тел: {$user_phone} <br />
						Адрес: {$user_adress} ";
					
		$dateCreated	= time();
		$user_ip	= $_SERVER['REMOTE_ADDR'];
		//<
		
		// формирование запроса к БД
		$sql = "INSERT INTO 
				orders (`user_id`, `date_created`, `date_payment`, 
						`status`, `comment`, `user_ip`)  
			VALUES ('{$user_id}', '{$dateCreated}', null, 
						'0', '{$comment}', '{$user_ip}')";

	$result = $this->querySqlWithTryCatch($sql);
	
	// получить order_id созданного заказа
	if($result){
		$sql = "SELECT order_id 
					FROM orders 
					ORDER BY order_id DESC
					LIMIT 1";
		$result = $this->querySqlWithTryCatch($sql);
		// преобразование результатов запроса
		$result = $this->getArrayResult($result);
		// возвращаем order_id созданного запроса
		if(isset($result[0])){
			return $result[0]['order_id'];
		}
	}
	return false;
	}

	/**
	 * Получить список заказов с привязкой к продуктам для пользователя $user_id
	 * 
	 * @param integer $user_id ID пользователя
	 * @return array массив заказов с привязкой к продуктам 
	 */
	function getOrdersWithProductsByUser($user_id)
	{	
		$user_id = intval($user_id);
		$sql = "SELECT * FROM orders
				WHERE `user_id` = '{$user_id}'
				ORDER BY order_id DESC";
		
		$result = $this->querySqlWithTryCatch($sql);

		$arrayResult = array();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$rsChildren = $this->getPurchaseForOrder($row['order_id']);
			if($rsChildren){
				$row['children'] = $rsChildren;
				$arrayResult[] = $row;
			}else{
			$arrayResult[] = $row;
			}
		}
		return $arrayResult;	
	}

	public function getPurchaseForOrder($order_id)
	{
		$sql = "SELECT `pe`.*, `ps`.`product_name` 
				FROM purchase as `pe`
				JOIN products as `ps` ON `pe`.product_id = `ps`.product_id
				WHERE `pe`.order_id = {$order_id}";
	
		$result =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}

	public function getOrders()
	{
		$sql = "SELECT o.*, u.user_name, u.user_email, u.user_phone, u.user_adress
				FROM orders as `o`
				LEFT JOIN users as `u` ON o.user_id = u.user_id
				ORDER BY order_id DESC";
		$result =  $this->querySqlWithTryCatch($sql);

		$arrayResult = array();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$rsChildren = $this->getProductsForOrder($row['order_id']);
			if($rsChildren){
				$row['children'] = $rsChildren;
				$arrayResult[] = $row;
			}else{
				$arrayResult[] = $row;
			}
		}
		return $arrayResult;
	}

	public function getProductsForOrder($order_id)
	{
		$sql = "SELECT *
				FROM purchase as `pe`
				LEFT JOIN products as `ps`
				ON pe.product_id = ps.product_id
				WHERE `order_id` = '{$order_id}'";
		$result =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}

	public function updateOrderStatus($itemId, $status)
	{

		$sql = "UPDATE orders
				SET `status` = '$status'
				WHERE `order_id` = '{$itemId}'";
		return $this->querySqlWithTryCatch($sql);
	}

	public function updateOrderDatePayment($itemId, $date_payment){
		$sql = "UPDATE orders
				SET `date_payment` = '$date_payment'
				WHERE `order_id` = '{$itemId}'";
		return $this->querySqlWithTryCatch($sql);
	}
}