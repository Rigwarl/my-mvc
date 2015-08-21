<?php

class User {
	private $data;

	function __construct(){
		session_start();
		$this->data = globals::session(array(
			'id',
			'login',
			'class',
			'lastlink',
			'backlink'
		));
	}

	// must be called after check what page exists
	public function updateLinks(){
		global $url;
		$links = array('lastlink' => '/' . $url);

		if (!$this->data['backlink']) {
			$links['backlink'] = '/' . $url;
		} elseif ('/' . $url !== $this->data['lastlink']) {
			$links['backlink'] = $this->data['lastlink'];
		}

		globals::set_session($links);
		$this->data = array_merge($this->data, $links);
	}

	public function get($item) {
		return $this->data[$item];
	}

	public function is($class) {
		if (is_array($class)){
			foreach ($class as $item){
				if ($this->data['class'] === $item){
					return true;
				}
			}
		} elseif ($this->data['class'] === $class){
			return true;
		}

		return false;
	}
}