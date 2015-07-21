<?php

function validate($data, $ruleset){
	$errors = array();
	foreach ($ruleset as $field_name => $rules) {
		$rules = explode('|', $rules);

		foreach ($rules as $rule) {
			$error = check($data, $field_name, $rule);

			if ($error) {
				$errors[$field_name] = $error;
				break;
			}
		}
	}

	return $errors;
}

function check($data, $field_name, $rule){
	$rule = explode(':', $rule);
	$rule_name = $rule[0];
	$rule_val = isset($rule[1]) ? $rule[1] : false;
	$field = isset($data[$field_name]) ? $data[$field_name] : '';
	$error = false;
	
	switch ($rule_name) {
		case 'required':
			if (!$field) {
				$error = $rule_name;
			}
			break;

		case 'min_len':
			if (strlen($field) < $rule_val) {
				$error = $rule_name;
			}
			break;

		case 'email':
			// todo change to regular exp
			if (!stripos($field, '@') || !stripos($field, '.')) {
				$error = $rule_name;
			}
			break;

		case 'equal':
			$equal_to = isset($data[$rule_val]) ? $data[$rule_val] : '';
			if ($field != $equal_to) {
				$error = $rule_name;
			}
			break;


		//must be last
		case 'not_required':
			break;

		default:
			throw new exception('no such a rule');
			break;
	}

	return $error;
}