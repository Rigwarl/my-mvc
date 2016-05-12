<?php

Class validator {
	// todo mb not static??
	private static $error  = false;
	private static $errors = array();
	private static $data   = array();
	private static $field_name;
	private static $rule_name;

	public static function validate($data, $ruleset){
		self::$data = $data;
		self::$errors = array();

		foreach ($ruleset as $field_name => $rules) {
			self::$field_name = $field_name;
			self::check_field($rules);
		}

		return self::$errors;
	}

	private static function check_field($rules){
		$field = isset(self::$data[self::$field_name]) ? self::$data[self::$field_name] : '';
		$rules = explode('|', $rules);

		// if not required and empty stop checking
		if ($rules[0] === 'not_required' && $field === '') {
			return;
		}

		foreach ($rules as $rule) {
			$rule = explode(':', $rule);

			self::$rule_name = $rule[0];
			$rule_val = isset($rule[1]) ? $rule[1] : false;

			$error = self::check_rule($field, $rule_val);

			// stop checking field on first error
			if (self::$error){
				self::$error = false;
				break;
			}
		}
	}

	private static function check($condition){
		if ($condition){
			self::$errors[self::$field_name] = self::$rule_name;
			self::$error = true;
		}
	}

	private static function check_rule($field, $rule_val){
		switch (self::$rule_name) {
			case 'required':
				self::check($field === '');
				break;

			case 'min_len':
				self::check(strlen($field) < $rule_val);
				break;

			case 'email':
				// todo change to regular exp
				self::check(!stripos($field, '@') || !stripos($field, '.'));
				break;

			case 'equal':
				$equal_to = isset(self::$data[$rule_val]) ? self::$data[$rule_val] : '';
				self::check($field != $equal_to);
				break;

			case 'date':
				$format = $rule_val ?: 'Y-m-d';
				$d = DateTime::createFromFormat($format, $field);
				self::check(!$d || !($d->format($format) == $field));
				break;

			case 'number':
				self::check(!is_numeric($field));
				break;

			case 'int':
				self::check(!is_int($field));
				break;

			case 'min':
				self::check($field < $rule_val);
				break;

			case 'max':
				self::check($field > $rule_val);
				break;


			//must be last
			case 'not_required':
				break;

			default:
				throw new exception('no such a rule');
				break;
		}
	}
}