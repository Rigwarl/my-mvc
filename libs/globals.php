<?php

function get_one_from($value, $array){
	return isset($array[$value]) ? $array[$value] : false;
}

function get_from($value, $array){
	if (is_array($value)) {
		$result = array();

		foreach ($value as $item) {
			$result[$item] = get_one_from($item, $array);
		}
	} else {
		$result = get_one_from($value, $array);
	}

	return $result;
}

function set_array($array_old, $array_new){
	foreach ($array_new $key => $value){
		$array_old[$key] = $value; 
	}
}

function post($value){
	return get_from($value, $_POST);
}

function get($value){
	return get_from($value, $_GET);
}

function session($value){
	return get_from($value, $_SESSION);
}

function set_session($array){
	return set_array($_SESSION, $array);
}