<?php


class PurchaseModel extends MainModel{

	/**
	* Модель для таблицы продукции (purchase)
	* 
	*/

	/**
	*  Внесение в БД данных продуктов с привязкой к заказу
	*
	* @param integer $order_id ID заказа
	* @param array $basket массив корзины 
	* @return boolean TRUE в случае успешного добавления в БД
	*/
	public function setPurchaseForOrder($order_id, $basket)
	{
		$sql = "INSERT INTO purchase
				(order_id, product_id, price, amount) 
				VALUES ";
		
		$values = array();
		// формируем массив строк для запроса для каждого товара
		foreach ($basket as $item) {
			$values[] = "({$order_id}, {$item['product_id']}, {$item['product_price']}, {$item['cnt']})";
		}
		// преобразовываем массив в строку
		$sql .= implode($values, ', ');
		$result = $this->querySqlWithTryCatch($sql);

		return $result;
	}
}