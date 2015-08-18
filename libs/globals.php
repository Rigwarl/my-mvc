<?php

Class globals {
	private static function get_one_from($value, $array){
		return isset($array[$value]) ? $array[$value] : false;
	}

	private static function get_from($value, $array){
		if (is_array($value)) {
			$result = array();

			foreach ($value as $item) {
				$result[$item] = self::get_one_from($item, $array);
			}
		} else {
			$result = self::get_one_from($value, $array);
		}

		return $result;
	}

	private static function set_array(&$array_old, $array_new){
		foreach ($array_new as $key => $value){
			$array_old[$key] = $value; 
		}
	}

	private static function unset_array(&$array_old, $array_new){
		foreach ($array_new as $item){
			unset($array_old[$item]); 
		}
	}

	public static function post($value){
		return self::get_from($value, $_POST);
	}

	public static function get($value){
		return self::get_from($value, $_GET);
	}

	public static function session($value){
		return self::get_from($value, $_SESSION);
	}

	public static function set_session($value, $value_string = true){
		if (!is_array($value)){
			$value = array( $value => $value_string );
		}
		return self::set_array($_SESSION, $value);
	}

	public static function unset_session($value){
		if (is_array($value)){
			self::unset_array($_SESSION, $value);
		} else {
			unset($_SESSION[$value]);
		}
	}

	public static function extract_session($value){
		$session = self::session($value);
		self::unset_session($value);

		return $session;
	}

	public static function is_post(){
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
}