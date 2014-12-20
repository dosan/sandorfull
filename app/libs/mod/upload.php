<?php

try {
	$objValid = new Validation();
	$allowedExt = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx');
	if ($_FILES) {
		if ($_FILES['ssdUploadfile']['error'] == 0) {
			$extension = Helper::getExtension($_FILES['ssdUploadfile']['name']);
			if (!in_array($extension, $allowedExt)) {
				$throw new Exception($objValid->_validation['file_extension'])
			}
		}
	}
} catch (Exception $e) {
	echo json_encode(array('error' => true, 'message' => $e->getMessage()));
}