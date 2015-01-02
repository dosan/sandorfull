<?php

class Contact extends Controller
{
	public function index()
	{
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'contact'.DS.'index.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
		$this->clear();
	}
	public function upload(){
		try {
			$objValid = new Validation();
			$allowedExt = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx');
			if ($_FILES) {
				if ($_FILES['ssdUploadFile']['error'] == 0) {
					$extension = Helper::getExtension($_FILES['ssdUploadFile']['name']);
					if (!in_array($extension, $allowedExt)) {
						throw new Exception($objValid->_validation['file_extension']);
					}
					if ($_FILES['ssdUploadFile']['size'] > MAX_SIZE) {
						throw new Exception($objValid->_validation['file_size'].' of'. Helper::bytesToSize(MAX_SIZE));
					}
					$fileName = date('YmdHis').'_'.mt_rand().'.'.$extension;
					move_uploaded_file($_FILES['ssdUploadFile']['tmp_name'], UPLOAD_PATH.$fileName.'.'.FILE_EXT);
					echo json_encode(array(
						'error' => false,
						'name' => $fileName,
						'nameOriginal' => $_FILES['ssdUploadFile']['name'],
						'size' => $_FILES['ssdUploadFile']['size'],
						'sizeReadable' => Helper::bytesToSize($_FILES['ssdUploadFile']['size']),
						'ext' => $extension
					));
				}else{
					throw new Exception($objValid->_validation[$_FILES['ssdUploadFile']['error']]);
				}
			}else{
				throw new Exception($objValid->_validation[$_FILES['file_not_found']]);
			}
		} catch (Exception $e) {
			echo json_encode(array('error' => true, 'message' => $e->getMessage()));
		}
	}
	

	public function remove(){
		try {
			if (!empty($_POST['name'])) {
				
				$name = $_POST['name'];
				$file = UPLOAD_PATH.$name.'.'.FILE_EXT;

				if (is_file($file)) {
					unlink($file);
					echo json_encode(array('error' => false));
				}else{
					throw new Exception("File not found");
				}
			}else{
				throw new Exception("Empty name string");
			}

		} catch (Exception $e) {
			echo json_encode(array('error' => true, 'message' => $e->getMessage()));
		}
	}


	public function send(){

		try {
			if (isset($_POST['fields'])) {
				$expected = array(
					'type', 'fullName', 'telephone', 'email', 'enquiry'
				);
				$required = array(
					'type', 'fullName', 'telephone', 'email', 'enquiry'
				);
				$objForm = new Form();
				$objValid = new Validation();
				$objValid->_expected = $expected;
				$objValid->_required = $required;
				$objValid->_special = array('email' => 'email');

				$array = $objForm->post2ArraySerialize($_POST['fields'], $expected);

				$attachments = null;

				if (!empty($_POST['files'])) {
					$attachments = $_POST['files'];
				}
				if ($objValid->isValid($array)) {
					$objEmail = new Email();
					$objEmail->setFrom($array['email'], $array['fullName']);
					$objEmail->addReplyTo($array['email'], $array['fullName']);
					$objEmail->setTo(EMAIL_TO, NAME_TO);
					$objEmail->setSubject('Enquiry from our website');
					$objEmail->setBody($objEmail->parse('1', $array));
					$filesToRemove = array();

					if (!empty($attachments)) {
						foreach ($attachments as $item) {
							rename(
								UPLOAD_PATH.$item['newName'].'.'.FILE_EXT,
								UPLOAD_PATH.$item['newName']
								);
							$objEmail->addAttachment(UPLOAD_PATH,$item['newName'], $item['oldName']);

							$filesToRemove[] = UPLOAD_PATH.$item['newName'];
						}
					}
					if ($objEmail->send($array['type'])) {
						Helper::removeFiles($filesToRemove);
						$message = '<h1>Thank you</h1>';
						$message .= '<p>Your message has been sent successfully</p>';

						echo json_encode(array('error' => false,  'message' => $message));
					}else{
						throw new Exception($objEmail->_error);
					}
				}else{
					throw new Exception('validation error');
				}
			}else{
				throw new Exception('Missing post');
			}
		} catch (Exception $e) {
			$message = $e->getMessage();

				echo json_encode(array(
					'error' => true,
					'message' => $message
				));
		}
	}

	public function sendMulti(){
		try {
			if (isset($_POST['fields'])) {
				$expected = array(
					'type', 'fullName', 'telephone', 'email', 'enquiry'
				);
				$required = array(
					'type', 'fullName', 'telephone', 'email', 'enquiry'
				);
				$objForm = new Form();
				$objValid = new Validation();
				$objValid->_expected = $expected;
				$objValid->_required = $required;
				$objValid->_special = array('email' => 'email');

				$array = $objForm->post2ArraySerialize($_POST['fields'], $expected);

				$attachments = null;

				if (!empty($_POST['files'])) {
					$attachments = $_POST['files'];
				}
				if ($objValid->isValid($array)) {
					$objEmail = new Email();
					$objEmail->setFrom($array['email'], $array['fullName']);
					$objEmail->addReplyTo($array['email'], $array['fullName']);
					$objEmail->setSubject('Enquiry from our website');
					$objEmail->setBody($objEmail->parse('1', $array));
					$filesToRemove = array();

					if (!empty($attachments)) {
						foreach ($attachments as $item) {
							rename(
								UPLOAD_PATH.$item['newName'].'.'.FILE_EXT,
								UPLOAD_PATH.$item['newName']
								);
							$objEmail->addAttachment(UPLOAD_PATH,$item['newName'], $item['oldName']);

							$filesToRemove[] = UPLOAD_PATH.$item['newName'];
						}
					}
					$errors = array();
					$arrayRecip = array(
						array('email' => 'mr.seitkanov@mail.ru', 'name' => 'dosan'),
						array('email' => 'mr.seitkanov@yandex.com', 'name' => 'dosan')
					);

					foreach ($arrayRecip as $row) {
						$objEmail->setTo($row['email'], $row['name']);
						if (!$objEmail->send($array['type'])) {
							$errors = $row['email'];
						}
					}

					if (!empty($errors)) {
						Helper::removeFiles($filesToRemove);
						$message = '<h1>Thank you</h1>';
						$message .= '<p>Your message has been sent successfully</p>';

						echo json_encode(array('error' => false,  'message' => $message));
					}else{
						throw new Exception($objEmail->_error);
					}
				}else{
					throw new Exception('validation error');
				}
			}else{
				throw new Exception('Missing post');
			}
		} catch (Exception $e) {
			$message = $e->getMessage();
			echo json_encode(array(
				'error' => true,
				'message' => $message

			));
			
		}
	}

	public function clear(){
		$files = Helper::getFilesByExtension(UPLOAD_PATH, FILE_EXT);
		if (!empty($files)) {
			foreach ($files as $file) {
				$fileArray = explode(DS, $file);
				$fileName = array_pop($fileArray);
				$fileNameArray = explode('_', $fileName);
				$fileNameDate = array_shift($fileNameArray);

				$dateTime = date('Y-m-d H:i:s', strtotime(
					substr($fileNameDate, 0, 4).'-'
					.substr($fileNameDate, 4, 2).'-'
					.substr($fileNameDate, 6, 2).' '
					.substr($fileNameDate, 8, 2).':'
					.substr($fileNameDate, 10, 2).':'
					.substr($fileNameDate, 12, 2)
				));
				$dateTimeOver = strtotime($dateTime . ' + 1 hour');
				if (time() > $dateTimeOver) {
					unlink($file);
				}
			}
		}
	}

}
