<?php

class Admin extends Controller
{
	public $resultCategories;

	public $resultMainCategories;

	public $resultOrders = null;

	public function index()
	{
		$this->resultCategories = $this->categories_model->getAllMainCategories();

		$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
		$this->loadViewTemplFolderTemplName('admin','index.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
	}
	public function addNewCategory(){
			$cat_name = trim(strip_tags($_POST['newCategoryName']));
			$cat_parent_id = $_POST['generalCatId'];

			$result = $this->categories_model->insertCategory($cat_name, $cat_parent_id);
			if ($result) {
				$resultData['success'] = 1;
				$resultData['message'] = 'Категория дабавлена';
			}else{
				$resultData['success'] = 0;
				$resultData['message'] = 'Ошибка добавления категории';
			}
			echo json_encode($resultData);
			return;

	}
	/**
	* Страница управления категориями
	*/
	public function category(){
		$this->resultCategories = $this->categories_model->getAllCategories();
		$this->resultMainCategories = $this->categories_model->getAllMainCategories();

		$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
		$this->loadViewTemplFolderTemplName('admin','admincategory.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
	}
	/**
	* Обновление данных категории
	**/
	public function updatecategory(){
			$item_id = intval($_POST['item_id']);
			$parent_id = intval($_POST['parent_id']);
			$new_name = trim(strip_tags($_POST['new_name']));
			$res = $this->categories_model->updateCategoryData($item_id, $parent_id, $new_name);

			if ($res) {
				$resData['success'] = 1;
				$resData['message'] = 'Категория обновлена';
			}else{
				$resData['success'] = 0;
				$resData['success'] = 'Ошибка изменения данных категории';
			}
			echo json_encode($resData);
			return;
	}
	/**
	* Страница управления категориями
	*/
	public function products(){

			$this->resultCategories = $this->categories_model->getAllCategories();
			$products_model = $this->model('ProductsModel');
			$this->resultProducts = $products_model->getProducts();
			$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminproducts.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
	}
	public function getDataFromAngular(){
		$data = file_get_contents("php://input");
		return json_decode($data);
	} 

	/**
	* Добавление нового товара
	**/
	public function addProduct(){
		$resData = array();
		$productData = $this->getDataFromAngular();
		
		$products_model = $this->model('ProductsModel');
		
		if($products_model->getDuplicate(1, 'product_name', 'products', 'product_name', $productData->name)){
			$resData['success'] = 0;
			$resData['message'] = 'Такой товар уже существует';
		}else{
			$res = $products_model->insertProduct($productData->name, get_in_translate_to_en($productData->name), $productData->price, $productData->description, (int)$productData->category);
			if ($res) {
				$resData['success'] = 1;
				$resData['message'] = 'Товар успешно добавлен!';
			}else{
				$resData['success'] = 0;
				$resData['message'] = 'Ошибка изменения данных';
			}
		}
		echo json_encode($resData);
	}
	public function updateProduct(){
			$itemId      = $_POST['itemId'];
			$itemName    = $_POST['itemName'];
			$itemPrice   = $_POST['itemPrice'];
			$itemStatus  = $_POST['itemStatus'];
			$itemDesc    = $_POST['itemDesc'];
			$itemCat     = $_POST['itemCat'];
			//$newFileName = $_POST['newFileName'];

			$products_model = $this->model('ProductsModel');
			$res = $products_model->updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);

			if ($res) {
				$resData['success'] = 1;
				$resData['message'] = 'Изменение успещно внесены';
			}else{
				$resData['success'] = 0;
				$resData['message'] = 'Ошибка изменения данных';
			}

			echo json_encode($resData);

	}

	public function upload(){
			$maxSize = 2 * 1024 * 1024;

			$itemId     = $_POST['itemId'];
			// получаем расширение загружаемого файла
			$ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
			$newFileName = $itemId . '.'. $ext;

			if ($_FILES['filename']['size'] > $maxSize) {
				echo ('Размер файла превышает два мегобайта');
				return;
			}
			// Загружен ли файл
			if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
				// Если файл загружен то перемещаем его из временной директорий в конечную

				$res = move_uploaded_file($_FILES['filename']['tmp_name'], DOCUMENT_ROOT . 'public/img/products/' . $newFileName);
				if ($res) {
					$products_model = $this->model('ProductsModel');
					$res = $products_model->updateProductImage($itemId, $newFileName);
					if ($res) {
						header('location: '.URL.'admin/products/');
					}
				}
			}else{
				echo ('Ошибка загрузки файла');
			}

	}

	/**
	* Страница управления Заказами
	*/
	public function orders(){
		$order_model = $this->model('OrdersModel');
		$this->resultOrders = $order_model->getOrders();
		$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminorders.php', 1);
		$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
	}

	public function setOrderStatus(){
			$itemId = intval($_POST['itemId']);
			$status = intval($_POST['status']);

			$order_model = $this->model('OrdersModel');
			$res = $order_model->updateOrderStatus($itemId, $status);
			if ($res) {
				$resData['success'] = 1;
			}else{
				$resData['success'] = 0;
				$resData['message'] = 'Ошибка установки статуса';
			}
			echo json_encode($resData);
			return;

	}
	public function setOrderDatePayment(){
			$itemId = intval($_POST['itemId']);
			$datePayment = $_POST['datePayment'] ? $_POST['datePayment'] : null;

			$order_model = $this->model('OrdersModel');
			$res = $order_model->updateOrderDatePayment($itemId, $datePayment);
			if ($res) {
				$resData['success'] = 1;
			}else{
				$resData['success'] = 0;
				$resData['message'] = 'Ошибка установки статуса';
			}
			echo json_encode($resData);
			return;

	}
}//endclass