<?php 
class Autoloader{

	public static function load($className = null){
		$class = str_replace('\\', DS, ltrim($className, '\\'));
		$class = str_replace('_', DS, $class).'.php';

		if (0 === strpos($className, 'Swift')) {
			@require_once(LIBS.DS.SwiftMailer.DS.$class);
		}else{
			@require_once(LIBS.DS.$class);
		}
	}


}