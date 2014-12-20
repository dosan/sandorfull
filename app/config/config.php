<?php
date_default_timezone_set('Asia/Almaty');

define('DEVELOPMENT_ENVIRONMENT', true);
define('URL', 'http://localhost/');
define('HOST_NAME', 'localhost');
// Папка сайта
// Папка сайта
defined("DS") || define('DS', DIRECTORY_SEPARATOR);
defined("DOCUMENT_ROOT") || define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].DS);
defined("PASS_COM_LIB") || define('PASS_COM_LIB', "app".DS."libs".DS."password_compatibility_library.php");
defined("ROOT_PATH") || define('ROOT_PATH', realpath(dirname(__FILE__) . DS . '..' . DS));
defined("UPLOAD_PATH") || define('UPLOAD_PATH', DOCUMENT_ROOT.'uploads'.DS.'');
defined("LIBS") || define('LIBS',  DOCUMENT_ROOT."app".DS."libs".DS);
defined("EMAILS_PATH") || define('EMAILS_PATH',  DOCUMENT_ROOT.'app'.DS.'views'.DS."emails".DS);
defined("MAX_SIZE") || define('MAX_SIZE', 1048576);
defined("FILE_EXT") || define('FILE_EXT', 'dat');
defined("SMTP_HOST") || define('SMTP_HOST', 'aspmx.l.google.com');
defined("SMTP_AUTHENTICATION") || define('SMTP_AUTHENTICATION', true);
defined("SMTP_PORT") || define('SMTP_PORT', 25);
defined("SMTP_USERNAME") || define('SMTP_USERNAME', '');
defined("SMTP_PASSWORD") || define('SMTP_PASSWORD', '');
defined("SMTP_ENCRYPTION") || define('SMTP_ENCRYPTION', '');
defined("EMAIL_TO") || define('EMAIL_TO', 'mr.seitkanov@mail.ru');
defined("NAME_TO") || define('NAME_TO', 'Dosan');
require_once(LIBS.DS.'Autoloader.php');
spl_autoload_register(array('Autoloader', 'load'));

define('IMAGES_PATH', $_SERVER['DOCUMENT_ROOT'].DS.'public'.DS.'img'.DS);
define('VIEWS_PATH', $_SERVER['DOCUMENT_ROOT'].DS.'app'.DS.'views'.DS);
define('CONTROLLER_PATH' , $_SERVER['DOCUMENT_ROOT'].DS.'app'.DS.'controller'.DS);
define('CONNECTION_FAILED', 'Database connection could not be established.');
define('CSS_PATH' , URL.'public'.DS.'css'.DS);
define('JS_PATH' , URL.'public'.DS.'js'.DS);
define('IMG_PATH' , URL.'public'.DS.'img'.DS);


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sandor');
define('DB_USER', 'root');
define('DB_PASS', 'password1');
define('SES_PR' , 'test_task');