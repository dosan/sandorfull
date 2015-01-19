<?php

class Basket extends Controller
{
	/**
	* @var array $child_cats data of children Categories
	*/
	public $child_cats = null;
	/**
	* @var array $products data of products
	*/
	public $product = null;
	/**
	* @var array $cat_data data of the category
	*/
	public $cat_data = null;

	public $message = array();
	public $hideLoginBox = 0;
	public $resultProducts;
	public $productInBasket = 0;
	/**
	* Воводим прдуктов в корзине
	* 
	**/
	public function index(){
		$product_model = $this->model('ProductsModel');
		if (0 !== count($_SESSION['basket'])) {
			$this->product = $product_model->getProductsFromArray($_SESSION['basket']);
		}
		$this->loadViewTemplFolderTemplName('basket','index.php');
	}
	/**
	* Воводим информацию о продукте
	* 
	* @param $product_id integer index product id
	**/
	public function addToBasket($product_id){
		$resultData = array();

		$product_id = intval($product_id);
		if (!$product_id) return false;
		if(isset($_SESSION['basket']) && array_search($product_id, $_SESSION['basket']) === false){
			$_SESSION['basket'][] = $product_id;
			$resultData['countProducts'] = count($_SESSION['basket']);
			$resultData['success'] = 1;
		} else {
			$resultData['success'] = 0;
		}
		echo json_encode($resultData);
	}
	/**
	* Удаление продукта из корзины
	* 
	* @param integer product_id - ID удаляемого из корзины продукта
	* @return json информация об операции (успех, колво элементов в корзине) 
	*/
	public function removeFromBasket($product_id){
		$resultData = array();
		$product_id = intval($product_id);
		
		$key = array_search($product_id, $_SESSION['basket']);
		if ($key !== false) {
			unset($_SESSION['basket'][$key]);
			$resultData['success'] = 1;
			$resultData['countProducts'] = count($_SESSION['basket']); 
		}else{
			$resultData['success'] = 0;
		}
		echo json_encode($resultData);
	}

	/**
	* Формирование страницы заказа
	* 
	*/
	public function order(){
		// получаем массив идентификаторов (ID) продуктов корзины
		$products = isset($_SESSION['basket']) ? $_SESSION['basket'] : null;

		// если корзина пуста то редиректим в корзину
		if(! $products){
			header('location: '.URL.'basket');
			return;
		}
		// полученный массив покупаемых товаров помещаем в сессионную переменную

		// получаем из массива $_GET количество покупаемых товаров
		$itemsCnt = array();
		foreach($products as $item){
			// формируем ключ для массива POST
			$postVar = 'itemCount_' . $item;
			// создаем элемент массива количества покупаемого товара
			// ключ массива - ID товара, значение массива - количество товара
			// $itemsCnt[1] = 3;  товар с ID == 1 покупают 3 штуки
			$itemsCnt[$item] = isset($_GET[$postVar]) ? $_GET[$postVar] : null;
		}

		$product_model = $this->model('ProductsModel');
		// получаем список продуктов по массиву корзины
		$this->resultProducts = $product_model->getProductsFromArray($products);
		// добавляем каждому продукту дополнительное поле 
		// "realPrice = количество продуктов * на цену продукта"
		// "cnt" = количество покупаемого товара
		// &$item - для того чтобы при изменении переменной $item 
		// менялся и элемент массива $rsProducts
		$i = 0;
		foreach($this->resultProducts as &$item){
			$item['cnt'] = isset($itemsCnt[$item['product_id']]) ? $itemsCnt[$item['product_id']] : 0;

			if($item['cnt']){
				$item['realPrice'] = $item['cnt'] * $item['product_price'];
			} else {
				// если вдруг получилось так что товар в корзине есть, а количество == нулю,
				// то удаляем этот товар
				unset($this->resultProducts[$i]);
			}
			$i++;
		}
		
		if($products = null){
			$this->message[] = 'Basket is empty!';
			return $this->message;
		}
		
		$_SESSION['saleBasket'] = $this->resultProducts;
		
		// hideLoginBox переменная - флаг для того чтобы спрятать блоки логина и регистрации 
		// в боковой панели
		if(Session::get('user_login_status') == 1){
			$this->hideLoginBox = 1;
		}

		$this->loadViewTemplFolderTemplName('basket','order.php');
	}
	 /**
	 *  AJAX функция сохраниение заказа
	 * 
	 * @param array $_SESSION['saleCart'] массив покупаемых продуктов
	 * @return json информация о результате выполнения 
	 */
	public function saveorder()
	{
		$resData = array();
		// получаем массив покупаемых товаров
		$basket = isset($_SESSION['saleBasket']) ? $_SESSION['saleBasket'] : null;
		// если корзина пуста, то формируем ответ с ошибкой, отдаем его в формате 
		// json и выходим из функции 
		if(! $basket){
			$resData['success'] = 0; 
			$resData['message'] = 'Нет товаров для заказа'; 
			echo json_encode($resData);
			return;
		}
		$user_name	= trim(strip_tags($_POST['user_name']));
		$user_phone	= trim(strip_tags($_POST['user_phone']));
		$user_adress = trim(strip_tags($_POST['user_adress']));
		
		$order_model = $this->model('OrdersModel');

		// создаем новый заказ и получаем его ID
		$order_id = $order_model->makeNewOrder($user_name, $user_phone, $user_adress);
		
		// если заказ не создан, то выдаем ошибку и завершаем функцию
		if(! $order_id){
			$resData['success'] = 0; 
			$resData['message'] = 'Ошибка создания заказа'; 
			echo json_encode($resData);
			return;
		} 

		// сохраняем товары для созданного заказа
		$purchase_model = $this->model('PurchaseModel');
		$result = $purchase_model->setPurchaseForOrder($order_id, $basket);

		
		// если успешно, то формируем ответ, удаляем переменные корзины
		if($result){
			$resData['success'] = 1; 
			$resData['message'] = 'Заказ сохранен';
			unset($_SESSION['saleBasket']);
			unset($_SESSION['basket']);
		} else {
			$resData['success'] = 0; 
			$resData['message'] = 'Ошибка внесеня данных для заказа № ' . $order_id; 
		}
		echo json_encode($resData);
	}
}
