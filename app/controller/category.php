<?php


class Category extends Controller
{
	/**
	 * @var array $child_cats data of children Categories
	 */
	public $child_cats = null;
	/**
	 * @var array $products data of products
	 */
	public $products = null;
	/**
	 * @var array $cat_data data of the category
	 */
	public $cat_data = null;

	public function index()
	{
		$prudcts_model = $this->model('ProductsModel');
		$this->products = $prudcts_model->getLastProducts(20);
		$this->loadViewTemplFolderTemplName('home', 'index.php');
	}

	/**
	* функция возвращает содержание категории, если это родительския категория то возвращает ее дочерние категории
	* 
	* @param $cat_id integer index category id
	**/
	public function getId($cat_id){
		// categories_model(CategoryModel) declared in libs/controller.php because it for all pages
		$this->cat_data = $this->categories_model->getCategoryRecordsById($cat_id);
		// если главная категория то показываем дочернии категории,
		// иначе показывает товар
		if ($this->cat_data['parent_id'] == 0) {
			$this->child_cats = $this->categories_model->getChildrenCategories($cat_id);
		}else{
			$this->products = $this->categories_model->getProductsByCat($cat_id);
		}
		$this->loadViewTemplFolderTemplName('category','getid.php');
	}

}
