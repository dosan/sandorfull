<?php 

class User extends Controller{

	public $message = array();
	public $result = array();
	/**
	 * 	Страница о пользователе
	 * 	users profile
	 */
	public function index()
	{
		require VIEWS_PATH.'layouts/header.php';
		if (Session::get('user_login_status') != 1)
		require VIEWS_PATH.'user/login.php';
		else
		require VIEWS_PATH.'user/index.php';
		require VIEWS_PATH.'layouts/footer.php';
	}
	/**
	 * user login with ajax
	 * @return [array] [json encode]
	 */
	public function login(){
		try {
			if (!empty($_POST['fields'])) {
				$expected = array(
					'user_name', 'user_password'
				);
				$required = array(
					'user_name', 'user_password'
				);
				$objForm = new Form();
				$objValid = new Validation();

				$array = $objForm->post2ArraySerialize($_POST['fields'], $expected);

				if ($objValid->isValid($array)) {

					$this->versionPhp() AND require PASS_COM_LIB;
					$user_model = $this->model('UserModel');
					$result = $user_model->loginUser($array['user_name'], $array['user_password']);
					
					if (!$result['success']) {
						throw new Exception("Wrong password or name");
					}else{
						echo json_encode(array('error' => false));
					}
				}else{
					throw new Exception($objValid->_errors);
				}
			}else{
				throw new Exception("Error Processing Request");
			}
		} catch (Exception $e) {
			$message = $e->getMessage();
			echo json_encode(array(
				'error' => true,
				'message' => $message
			));
		}
	}

	/**
	 * register new user 
	 * @return [view] [registration result]
	 */
	public function register()
	{
		try {
			if (!empty($_POST['fields'])) {
				$expected = array(
					'user_name', 'user_email', 'user_password', 'user_password_repeat'
				);
				$required = array(
					'user_name', 'user_email', 'user_password', 'user_password_repeat'
				);
				$objForm = new Form();
				$objValid = new Validation();

				$array = $objForm->post2ArraySerialize($_POST['fields'], $expected);
				if ($objValid->isValid($array)) {
					$usermodel = $this->model('UserModel');
					$this->versionPhp() AND require PASS_COM_LIB;
					$result = $usermodel->registerUser($array['user_name'], $array['user_email'], $array['user_password'], $array['user_password_repeat']);
					if (is_array($result)) {
						echo json_encode(array('error' => false));
					}
				}else{
					throw new Exception($objValid->_errors);
				}
			}else{
				require VIEWS_PATH.'layouts/header.php';
				require VIEWS_PATH.'user/register.php';
				require VIEWS_PATH.'layouts/footer.php';
			}
		} catch (Exception $e) {
			$message = $e->getMessage();

			echo json_encode(array(
				'error' => true,
				'message' => $message
			));
		}
	}
	/**
	 * simple logout function
	 * @return [redirect]
	 */
	public function logout(){
		// delete users session 
		$_SESSION = array();
		session_destroy();
		// return a little feeedback message
		$this->messages[] = "You have been logged out.";
		header('location: '.URL.'user/');
	}
	/**
	 * change language for users and guests
	 * @return [type] [description]
	 */
	public function changeLang(){
		if (isset($_REQUEST['language'])) {
			$retData = array();
			$language = isset($_REQUEST['language']) ? $_REQUEST['language'] : null;
			//if user auth true then change user's language, else guests language without saving to database
			if (Session::get('user_login_status') == 1) {
				$model = $this->model('UserModel');
				$result = $model->changeLang($language);
			}else{
				$result = Session::set('user_lang', $language);
			}
			if ($result) {
				$retData['success'] = 1;
			}else{
				$retData['success'] = 0;
				$retData['message'] = 'Error From Language select';
			}
			echo json_encode($retData);
		}else{
			header('location: '.URL.'404.html');
		}
	}
	/**
	 * [updateUser update user data]
	 * @return [type] [result]
	 */
	public function updateUser(){
		if (Session::get('user_login_status') == 1) {
			if (isset($_POST['current_password'])) {
				$this->versionPhp() AND require PASS_COM_LIB;
				$usermodel = $this->model('UserModel');
				$result = $usermodel->updateUserData();
				echo json_encode($result);
			}else{	
				header('location: '.URL.'user');
			}
		}else{
			header('location: '.URL.'user');
		}
	}
	/**
	 * impage uplooader
	 */
	public function imageUpload(){
		$resData = array();
		if (Session::get('user_login_status') == 1) {
			if ($_POST['user_name'] AND $_POST['item_id']) {
				if (!$_FILES['filename']['size']) {
					echo 'choose the image';
					return false;
				}
				$maxSize = 2 * 1024 * 1024;
				$item_id    = $_POST['item_id'];
				$user_name  = $_POST['user_name'];

				// получаем расширение загружаемого файла
				$ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
				$newFileName = $user_name . '.'. $ext;

				if ($_FILES['filename']['size'] > $maxSize) {
					echo ('Размер файла превышает два мегобайта');
					return;
				}
				// Загружен ли файл
				if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
					// Если файл загружен то перемещаем его из временной директорий в конечную
					$res = move_uploaded_file($_FILES['filename']['tmp_name'], IMAGES . $newFileName);
					if ($res) {
						$model = $this->model('UserModel');
						$res = $model->uploadImage($item_id, $newFileName);
						if ($res) {
							Session::set('user_img', $newFileName);
							header('location: '.URL.'user');
						}
					}
				}else{
					echo 'Ошибка загрузки файла';
				}
			}else{
				header('location: '.URL.'404.html');
			}
		}else{
			header('location: '.URL.'404.html');
		}
	}
}