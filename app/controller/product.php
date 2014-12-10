<?php

class Product extends Controller
{
	/**
	 * @var array $products data of products
	 */
	public $product = null;
	public $productInBasket = 0;
	public function index()
	{

		$prudcts_model = $this->model('ProductsModel');
		$this->products = $prudcts_model->getLastProducts(15);
		$this->loadViewTemplFolderTemplName('home','index.php');
	}

	/**
	* Воводим информацию о продукте
	* 
	* @param $product_id integer index product id
	**/
	public function getId($product_id){
		if(in_array($product_id, $_SESSION['basket'])){
			$this->productInBasket = 1;
		}
		$product_model = $this->model('ProductsModel');
		$this->product = $product_model->getProductById($product_id);
		$this->loadViewTemplFolderTemplName('product','getid.php');
	}

}
