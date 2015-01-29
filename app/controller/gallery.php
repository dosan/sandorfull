<?php

class Gallery extends Controller
{
	public function index(){
		$this->categories();
	}
	public function categories()
	{
		$model = $this->model('GalleryModel');
		if (isset($_POST['name'])) {
			$required = array('name');
			$missing = array();
			$validation = array(
				'name' => 'Please provide the category name',
				'duplicate' => 'This category name is already taken' 
			);
			foreach ($_POST as $key => $value) {
				$value = trim($value);
				if (empty($value) && in_array($key, $required)) {
					array_push($missing, $key);
				}else{
					${$key} = escape($value);
				}
			}
			if ($_POST['name'] != "" && $model->getDuplicate(1, 'name', 'gallery_categories', 'name', $name)) {
				array_push($missing, 'duplicate');
			}
			if (!empty($missing)) {
				$before = " <span class=\"warning\">";
				$after = "</span>";
				foreach ($validation as $key => $value) {
					if (in_array($key, $missing)) {
						${"valid_".$key} = $before.$value.$after;
					}
				}
			}else{
				$res = $model->insertCategory($name);
				if ($res) {
					$confirmation = "<p class=\"confirm\">The new category has been added successfully.</p>";
				}else{
					$confirmation = "<p class=\"warning\">The new category could not be added.</p>";
				}
			}
		}
		$categories = $model->getCategories();
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'home'.DS.'categories.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
	}
	public function edit($id)
	{
		$model = $this->model('GalleryModel');
		$category = $model->getCategory($id);
		if (isset($_POST['name'])) {
			$required = array('name');
			$missing = array();
			$validation = array(
				'name' => 'Please provide the category name',
				'duplicate' => 'This category name is already taken' 
			);
			foreach ($_POST as $key => $value) {
				$value = trim($value);
				if (empty($value) && in_array($key, $required)) {
					array_push($missing, $key);
				}else{
					${$key} = escape($value);
				}
			}
			if ($_POST['name'] != "" && $model->getDuplicate(2, 'name', 'gallery_categories', 'name', $name, 'id', $id)) {
				array_push($missing, 'duplicate');
			}
			if (!empty($missing)) {
				$before = " <span class=\"warning\">";
				$after = "</span>";
				foreach ($validation as $key => $value) {
					if (in_array($key, $missing)) {
						${"valid_".$key} = $before.$value.$after;
					}
				}
			}else{
				$res = $model->updateCategory($id, $name);
				if ($res) {
					$confirmation = "<p class=\"confirm\">The new category has been edited successfully. <br><a href=' ".URL." gallery'>Go back to the list of Categories.</a></p>";
				}else{
					$confirmation = "<p class=\"warning\">The new category could not be edited.</p>";
				}
			}
		}
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'home'.DS.'categories_edit.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
		
	}
	public function delete($id){
		try {
			if (!empty($id)) {
				$model = $this->model('GalleryModel');
				$images = $model->getImages($id);
				if (!empty($images)) {
					$model->deleteImages($images);
					foreach ($images as $image) {
						is_file(UPLOAD_PATH.$image) AND unlink(UPLOAD_PATH.$image);
						is_file(UPLOAD_PATH_THUMB.$image) AND unlink(UPLOAD_PATH_THUMB.$image);
					}
				}
				if($model->deleteCategory($id)){
					header('location: ' . URL . 'gallery/index');
				}else{
					throw new Exception("Error: Category could not be deleted");
				}

			}else{
				throw new Exception("Error: You should send id category for delete");
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function remove($id = null)
	{
		require VIEWS_PATH.'layouts'.DS.'header.php';
		if (isset($id)) {
			require VIEWS_PATH.'home'.DS.'categories_remove.php';
		}else{
			require_once VIEWS_PATH.'home'.DS.'error.php';
		}
		require VIEWS_PATH.'layouts'.DS.'footer.php';
	}
	public function getId($id)
	{
	$model = $this->model('GalleryModel');
		if (isset($_POST['update']) && $_POST['update'] == 'go') {
			unset($_POST['update']);
			$remove = array();
			$update = array();
			$confirmation = false;

			foreach ($_POST as $key => $value) {
				list($key, $rid) = explode("#", $key);
				if ($key == "remove" && $value == $rid) {
					array_push($remove, (int)$rid);
				}elseif ($key == 'display_order') {
					array_push($update, $rid.'#'.$value);
				}
			}
			if (!empty($remove)) {
				foreach ($remove as $file) {
					$name = $model->getFileName($file);
					is_file(UPLOAD_PATH_THUMB.$name) AND unlink(UPLOAD_PATH_THUMB.$name);
					is_file(UPLOAD_PATH.$name) AND unlink(UPLOAD_PATH.$name);
				}
				$model->deleteImages($remove);
			}
			if (!empty($update)) {
				foreach ($update as $key => $value) {
					list($rid, $value) = explode("#", $value);
					$result = $model->updateImage($value, $rid);
				}
				unset($update);
				if ($result) {
					$confirmation = "<p class=\"conf\">Record have been updated successfully.</p>";
				}
			}
		}
		if (isset($_POST['caption'])) {
			$required = array('caption');
			$missing = array();
			$validation = array(
				'caption' => 'Please provide the caption',
			);
			$filetypes = array('image/jpeg', 'image/gif', 'image/png', 'image/tiff');
			foreach ($_POST as $key => $value) {
				$value = trim($value);
				if (empty($value) && in_array($key, $required)) {
					array_push($missing, $key);
				}else{
					${$key} = escape($value);
				}
			}
			if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
				$validation['image_error'] = file_upload_error_message($_FILES['image']['error']);
				array_push($missing, 'image_error');
			}else{
				if ($_FILES['image']['size'] > MAX_UPLOAD_FILE_SIZE) {
					$validation['image_size'] = "The file size exceeds ".convert_size(MAX_UPLOAD_FILE_SIZE);
					array_push($missing, 'image_size');
				}elseif (!in_array($_FILES['image']['type'], $filetypes)) {
					$validation['image_type'] = "This file is not allowed ".convert_size(MAX_UPLOAD_FILE_SIZE);
					array_push($missing, 'image_type');
				}
			}
			if (!empty($missing)) {
				$before = " <span class=\"warning\">";
				$after = "</span>";
				foreach ($validation as $key => $value) {
					if (in_array($key, $missing)) {
						${"valid_".$key} = $before.$value.$after;
					}
				}
			}else{
				$file = pathinfo($_FILES['image']['name']);
				$ext = $file['extension'];
				$clean_caption = clean_string($caption);
				$new_name = strtolower($id."_".$clean_caption."-".date("Y-m-d-H-i-s", time()).".".$ext);

				$upload = move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_PATH.$new_name);
				if ($upload) {
					// create thumbnail image


				if(function_exists('exec')) {
					convert_image(
						UPLOAD_PATH.$new_name,
						UPLOAD_PATH_THUMB.$new_name,
						2,
						THUMB_WIDTH,
						THUMB_HEIGHT
					);
					// resize the image
					convert_image(
						UPLOAD_PATH.$new_name, 
						UPLOAD_PATH.$new_name, 
						1,
						LARGE_WIDTH
					);
				}
					$order = $model->getOrder(1, 'display_order', 'images', 'category', $id);
					$result = $model->insertImage($caption, $new_name, $id, $order);
					if ($result) {
						$caption = "";
						$confirm_message = "<p class=\"conf\">The file has been uploaded successfully.</p>";
					}
				}
			}
		}
		$images = $model->getAllImagesByCategory($id);
		$hd_script = "<link rel=\"stylesheet\" href=\"".URL."public/js/fancybox/jquery.fancybox.css\" type=\"text/css\">";
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'home'.DS.'images.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
	}
}