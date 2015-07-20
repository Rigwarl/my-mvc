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

function post($value){
	return get_from($value, $_POST);
}

function session($value){
	return get_from($value, $_SESSION);
}