<?php

Class Professors_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'professors';
	}

	public function add($data){
		$data = array_merge(array(
			'name' => '',
			'patronymic' => '',
			'surname' => '',
			'birth' => '',
			'about' => ''
		), $data);

		$result = array();

		if ($data['name'] == ''){
			$result['name'] = 'Name must not be blank';
		}

		if ($data['patronymic'] == ''){
			$result['patronymic'] = 'Patronymic must not be blank';
		}

		if ($data['surname'] == ''){
			$result['surname'] = 'Surname must not be blank';
		}

		if ($data['birth'] == ''){
			$result['birth'] = 'Birth must not be blank';
		}

		if (!$result) {
			$professor = array(
				'name' => $data['name'],
				'patronymic' => $data['patronymic'],
				'surname' => $data['surname'],
				'birth' => $data['birth']
			);
			// todo some check for unallowable symbols
			$saved = $this->save($professor);

			if (!$saved) {
				$result['error'] = 'Sorry, something went wrong. Please try later...';
			}
		}

		return $result;

	}
}