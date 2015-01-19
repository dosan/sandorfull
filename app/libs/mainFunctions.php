<?php

//IMAGE MAGIC FUNCTION
function convert_image($from, $to, $job, $new_w, $new_h = ''){
	if (file_exists($from)) {
		$convert_path = 'convert';
		$commands = '';
		$imginfo = getimagesize($from);
		$orig_w = $imginfo[0];
		$orig_h = $imginfo[1];
		switch ($job) {
			case 1:// resize
				if ($orig_w > $orig_h) {
					$commands .= ' -resize "'.$new_w.'"';
				}else{
					$commands .= ' -resize "x'.$new_w.'"';
				}
				break;
			case 2: //resize and crop
				if ($orig_w/$orig_h > $new_w/$new_h) {
					$commands .= ' -resize "x'.$new_h.'"';
					$resized_w = ($new_h/$orig_h) * $orig_w;
					$commands .= ' -crop "'.$new_w.'x'.$new_h.'+'.round(($resized_w - $new_w)/2).'+0';
				}else{
					$commands .= ' -resize "'.$new_w.'"';
					$resized_h = ($new_w/$orig_w) * $orig_h;
					$commands .= ' -crop "'.$new_w.'x'.$new_h.'+0+'.round(($resized_h - $new_h)/2).'"';
				}
				break;
		}
		$convert = $convert_path.' '.$from.' '.$commands.' '.$to;
		exec($convert);
	}
}

function clean_string($pharse){
	$r = strtolower($pharse);
	$r = preg_replace("/[^a-z0-9\s_]/", "", $r);
	$r = trim(preg_replace("/\s+/", "_", $r));
	$r = preg_replace("/\s/", "_", $r);
	return $r;
}
function convert_size($size){
	if ($size < 1024) {
		return "{$size} bytes";
	}elseif ($size < 1048576) {
		$size_kb = round($size/1024,1);
		return "{$size_kb} KB";
	}else {
		$size_mb = round($size/1048576, 1);
		return "{$size_mb} MB";
	}
}
function file_upload_error_message($error_code){
	switch ($error_code) {
		case UPLOAD_ERR_INI_SIZE:
			return 'The uploaded file exceeds the upload_max_file_size directive in php.ini';
		case UPLOAD_ERR_FORM_SIZE:
			return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
		case UPLOAD_ERR_PARTIAL:
			return 'The uploaded file was only partially uploaded';
		case UPLOAD_ERR_NO_FILE:
			return 'Please select the file';
		case UPLOAD_ERR_NO_TMP_DIR:
			return 'Missing a temporary folder';
		case UPLOAD_ERR_CANT_WRITE:
			return 'Filed to write file to disk';
		case UPLOAD_ERR_EXTENSION:
			return 'File upload stopped by extension';
		default:
			return 'Unknow upload error';			
	}
}
function getSize($case, $img){
	$file = getimagesize($img);
	switch ($case) {
		case 1:
			return $file[0];
			break;
		case 2:
			return $file[1];
		case 3:
			return $file[2];
			break;
		case 4:
			return $file[3];
			break;
	}

}
function escape($value){
	if (PHP_VERSION < 6) {
		$value = get_magic_quotes_gpc() ? stripcslashes($value) : $value;
	}
	return $value;
}
if (isset($_GET)) {
	foreach ($_GET as $key => $value) {
		$value = trim($value);
		if ($value != "") {
			${$key} = $value;
		}
	}
}
/** Check if environment is development and display errors **/
 
function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors',1);
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}
}
 
/** Check for Magic Quotes and remove them **/
 
function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}
 
function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}
 
/** Check register globals and remove them **/
 
function unregisterGlobals() {
	if (ini_get('register_globals')) {
		$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
		foreach ($array as $value) {
			foreach ($GLOBALS[$value] as $key => $var) {
				if ($var === $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}
/*function __autoload($classname) {
	$namespace = substr($classname, 0, strrpos($classname, '\\'));
	$namespace = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
	$classPath = DOCUMENT_ROOT . str_replace('\\', '/', $namespace) . '.php';
	if(is_readable($classPath)) {
		require_once $classPath;
	}
}*/
/**
 * Конвертация русских букв на англиский
 *
 * @param string $string строка для конвертций
 * @param boolean $gost булев тип для стандартной конвертаций если true
 */
function get_in_translate_to_en($string, $gost=false)
{
	if($gost)
	{
		$replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
				"Е"=>"E","е"=>"e","Ё"=>"E","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
				"Й"=>"I","й"=>"i","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n","О"=>"O","о"=>"o",
				"П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t","У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f",
				"Х"=>"Kh","х"=>"kh","Ц"=>"Tc","ц"=>"tc","Ч"=>"Ch","ч"=>"ch","Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch",
				"Ы"=>"Y","ы"=>"y","Э"=>"E","э"=>"e","Ю"=>"Iu","ю"=>"iu","Я"=>"Ia","я"=>"ia","ъ"=>"","ь"=>"");
	}
	else
	{
		$arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
		$arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");        
		$arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");
					
		$replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
				"Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
				"Й"=>"Y","й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n",
				"О"=>"O","о"=>"o","П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t",
				"У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch",
				"Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"",
				"Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu","Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye"," "=>"_", "."=>"_");
				
		$string = str_replace($arStrES, $arStrRS, $string);
		$string = str_replace($arStrOS, $arStrRS, $string);
	}
		
	return iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
}
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = addslashes($data);
		$data = strip_tags($data);
		return $data;
	}
/**
 * Редирект
 * 
 * @param string $url адрес для перенаправления 
 */
function redirect($url)
{
	header('location: ' . URL . "$url");
	exit; 
}
/**
 * Функция отладки. Останавливает работу програамы выводя значение переменной
 * $value
 * 
 * @param variant $value переменная для вывода ее на страницу 
 */
function d($value = null, $die = 1)
{
	echo 'Debug: <br /><pre>';
	print_r($value);
	echo '</pre>';
	
	if($die) die;
}
function isInteger($input){
	return(ctype_digit(strval($input)));
}
//setReporting();
removeMagicQuotes();
unregisterGlobals();