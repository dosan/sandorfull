<?php
class Form{
	public function post2ArraySerialize($post = null, $expected = null){
		if ($post) {
			$out = array();
			foreach ($post as $row) {
				$key = $row['name'];
				$value = $row['value'];
				if (!empty($expected)) {
					$expected = is_array($expected) ? $expected : array($expected);
					if (in_array($key, $expected)) {
						$out[$key] = $value;
					}
				}else{
					$out[$key] = $value;
				}
			}
			return $out;
		}
	}
}