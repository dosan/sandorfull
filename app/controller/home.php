<?php
		use Sandorpack\HelloThere;
/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
	/**
	 * @var array $products data last added products
	 */
	public $products;

	public function index()
	{
		// debug message to show where you are, just for the demo
		// echo 'Message from Controller: You are in the controller '.__CLASS__.', using the method '.__METHOD__;
		// load views. within the views we can echo out $songs and $amount_of_songs easily
		$con = new HelloThere();
		echo $con->world();
		$prudcts_model = $this->model('ProductsModel');
		$this->products = $prudcts_model->getLastProducts(10);
		$this->loadViewTemplFolderTemplName('home','index.php');
	}
}
