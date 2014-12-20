<?php

class Helper{

	public static function isEmpty($value){
		return empty($value) && !is_numeric($value) ? true : false;
	}

	public static function printArray($array = null){
		if (!empty($array)) {
			ob_start();
			echo '<pre>';
			print_r($array);
			echo '</pre';
			return ob_get_clean();
		}else{
			return 'Array is empty';
		}
	}
	public static function getExtension($file = null){
		if (!empty($file)) {
			$file = explode('.', $file);
			if (count($file) > 1) {
				return array_pop($file);
			}
		}
	}
	public static function getFilesByExtension($directory = null, $extensions = null){
		$extensions = is_array($extensions) ? $extensions : array($extensions);
		$extensions = "*." . implode(", *.", $extensions);
		$files = glob($directory.DS."{$extensions}", GLOB_BRACE);
		return $files;
	}
	public static function bytesToSize($bytes = 0, $precision = 2){
		$kilobyte = 1024;
		$megabyte = $kilobyte * 1024;
		$gigabyte = $megabyte * 1024;
		$terabyte = $gigabyte * 1024;

		if ($bytes >= 0 && $bytes < $kilobyte) {
			return $bytes . 'b';
		}else if ($bytes >= $kilobyte && $bytes < $megabyte) {
			return round($bytes / $kilobyte, $precision). 'kb';
		}else if ($bytes >= $megabyte && $bytes < $gigabyte) {
			return round($bytes / $megobyte, $precision). 'mb';
		}else if ($bytes >= $gigabyte && $bytes < $terabyte) {
			return round($bytes / $gigabyte, $precision). 'gb';
		}else if ($bytes >= $terabyte) {
			return round($bytes / $terobyte, $precision). 'tb';
		}else{
			return $bytes . 'b';
		}
	}


	public static function mergeArrays($array = null){
		if (!empty($array)) {
			$out = array();
			foreach ($array as $key => $value) {
				$value / is_array($value) ? $value : array($array);
				if(!empty($value)){
					$out = array_merge($out, $value);
				}else{
					$out = $value;
				}
			}
			return $out;
		}
	}


	public static function getMimeType($file = null){
		if (!empty($file) && is_file($file)) {
			if (class_exists('finfo', false)) {
				$objFinfo = new finfo(FILEINFO_MIME);
				$type = $objFinfo->file($file);
				return substr($type, 0, strpos($type, ';'));
			}else if (function_exists('mime_content_type')) {
				$mimetype = mime_content_type($file);
				return $mimetype;
			}	
		}
		return false;
	}


	public static function removeFiles($filesToRemove = null){
		if (!empty($filesToRemove)) {
			$filesToRemove = is_array($filesToRemove) ? $filesToRemove : array($filesToRemove);
			foreach ($filesToRemove as $file) {
				if (is_file($file)) {
					unlink($file);
				}
			}
		}
	}

	/**
	 * Конвертация русских букв на англиский
	 *
	 * @param string $string строка для конвертций
	 * @param boolean $gost булев тип для стандартной конвертаций если true
	 */
	public static function get_in_translate_to_en($string, $gost=false){
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
}