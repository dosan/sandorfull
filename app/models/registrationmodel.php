<?php

/**
 * Class registration
 * handles the user registration
 */
class RegistrationModel extends MainModel
{
	/**
	 * @var array $errors Collection of error messages
	 */
	public $errors = array();

	public $messages = array();

	/**
	 * handles the entire registration process. checks all error possibilities
	 * and creates a new user in the database if everything is fine
	 */
	public function registerNewUser()
	{
		if (empty($_POST['user_name'])) {
			$this->errors[] = "Empty Username";
		} elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
			$this->errors[] = "Empty Password";
		} elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
			$this->errors[] = "Password and password repeat are not the same";
		} elseif (strlen($_POST['user_password_new']) < 6) {
			$this->errors[] = "Password has a minimum length of 6 characters";
		} elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 4) {
			$this->errors[] = "Username cannot be shorter than 4 or longer than 64 characters";
		} elseif (!preg_match('/^[a-z\d]{4,64}$/i', $_POST['user_name'])) {
			$this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 4 to 64 characters";
		} elseif (empty($_POST['user_email'])) {
			$this->errors[] = "Email cannot be empty";
		} elseif (strlen($_POST['user_email']) > 64) {
			$this->errors[] = "Email cannot be longer than 64 characters";
		} elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors[] = "Your email address is not in a valid email format";
		} elseif (!empty($_POST['user_name'])
			&& strlen($_POST['user_name']) <= 64
			&& strlen($_POST['user_name']) >= 4
			&& preg_match('/^[a-z\d]{4,64}$/i', $_POST['user_name'])
			&& !empty($_POST['user_email'])
			&& strlen($_POST['user_email']) <= 64
			&& filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
			&& !empty($_POST['user_password_new'])
			&& !empty($_POST['user_password_repeat'])
			&& ($_POST['user_password_new'] === $_POST['user_password_repeat'])
		) {
				$user_password = trim(strip_tags($_POST['user_password_new']));
				// crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
				// hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
				// PHP 5.3/5.4, by the password hashing compatibility library
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
				$user_name = addslashes(trim(strip_tags($_POST['user_name'])));
				$user_email = $_POST['user_email'];
				$user_phone = isset($_POST['user_phone']) ? addslashes(trim(strip_tags($_POST['user_phone']))) : 0;
				$user_adress = isset($_POST['user_adress']) ? addslashes(trim(strip_tags($_POST['user_adress']))) : 0;
				
				// check if user or email address already exists
				$sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
				$query_check_user_name = $this->querySqlWithTryCatch($sql);

				if ($query_check_user_name->rowCount() == 1) {
					$this->errors[] = "Sorry, that username / email address is already taken.";
				} else {
					// write new user's data into database
					$sql = "INSERT INTO users (user_name, user_password_hash, ";
					if ($user_phone) {
						$sql .= "user_phone, ";
					}
					if ($user_adress) {
						$sql .= "user_adress, ";
					}
					$sql .= "user_email, time_reg)
							VALUES('" . $user_name . "', '" . $user_password_hash . "',";
					if ($user_phone) {
						$sql .= " $user_phone, ";
					}
					if ($user_adress) {
						$sql .= " '$user_adress', ";
					}
						$sql .= " '" . $user_email . "',".time().");";
					
					$query_new_user_insert =  $this->querySqlWithTryCatch($sql);

					// if user has been added successfully
					if ($query_new_user_insert) {
						$this->messages['success'] = "Your account has been created successfully. You can now log in.";
					} else {
						$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
					}
				}
			} else {
				$this->errors[] = "Sorry, no database connection.";
		}
		if(0 < count($this->errors)){
			return $this->errors;
		}else{
			return $this->messages;
		}
	}
}
