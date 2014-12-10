<?php

class Admin extends Controller
{

	public $resultCategories;

	public $resultMainCategories;

	public $resultOrders = null;

	public function index()
	{
		if (Session::get('user_range') == 'admin') {
			$this->resultCategories = $this->categories_model->getAllMainCategories();

			$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
			$this->loadViewTemplFolderTemplName('admin','index.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
		}else{
			header('location: '.URL);
		}
	}
	public function addNewCategory(){
		if (Session::get('user_range') == 'admin') {
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
		}else{
			header('location: '.URL);
		}
	}
	/**
	* Страница управления категориями
	*/
	public function category(){
		if (Session::get('user_range') == 'admin') {
			$this->resultCategories = $this->categories_model->getAllCategories();
			$this->resultMainCategories = $this->categories_model->getAllMainCategories();

			$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
			$this->loadViewTemplFolderTemplName('admin','admincategory.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
		}else{
			header('location: '.URL);
		}
	}
	/**
	* Обновление данных категории
	**/
	public function updatecategory(){
		if (Session::get('user_range') == 'admin') {
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
		}else{
			header('location: '.URL);
		}
	}
	/**
	* Страница управления категориями
	*/
	public function products(){
		if (Session::get('user_range') == 'admin') {

			$this->resultCategories = $this->categories_model->getAllCategories();
			$products_model = $this->model('ProductsModel');
			$this->resultProducts = $products_model->getProducts();

			$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminproducts.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
		}else{
			header('location: '.URL);
		}
	}
	/**
	* Добавление нового товара
	**/
	public function addProduct(){
		if (Session::get('user_range') == 'admin') {

			$itemName = trim(strip_tags($_POST['itemName']));
			$itemPrice = intval($_POST['itemPrice']);
			$itemDesc = trim($_POST['itemDesc']);
			$itemCat = intval($_POST['itemCat']);

			$products_model = $this->model('ProductsModel');
			$res = $products_model->insertProduct($itemName, $itemPrice, $itemDesc, $itemCat);
			
			if ($res) {
				$resData['success'] = 1;
				$resData['message'] = 'Товар успешно добавлен!';
			}else{
				$resData['success'] = 0;
				$resData['success'] = 'Ошибка изменения данных';
			}
			echo json_encode($resData);
			return;
		}else{
			header('location: '.URL);
		}
	}
	public function updateProduct(){
		if (Session::get('user_range') == 'admin') {

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
				$resData['success'] = 'Ошибка изменения данных';
			}
			echo json_encode($resData);
			return;
		}else{
			header('location: '.URL);
		}
	}

	public function upload(){
		if (Session::get('user_range') == 'admin') {

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
		}else{
			header('location: '.URL);
		}
	}

	/**
	* Страница управления Заказами
	*/
	public function orders(){
		if (Session::get('user_range') == 'admin') {
			$order_model = $this->model('OrdersModel');
			$this->resultOrders = $order_model->getOrders();
			$this->loadViewTemplFolderTemplName('admin','adminheader.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminsidebar.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminorders.php', 1);
			$this->loadViewTemplFolderTemplName('admin','adminfooter.php', 1);
		}else{
			header('location: '.URL);
		}
	}

	public function setOrderStatus(){
		if (Session::get('user_range') == 'admin') {

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
		}else{
			header('location: '.URL);
		}
	}
	public function setOrderDatePayment(){
		if (Session::get('user_range') == 'admin') {

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
		}else{
			header('location: '.URL);
		}
	}
}//endclass