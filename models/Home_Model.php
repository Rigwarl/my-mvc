<?php

Class Home_model extends Model {
	
	function getContent() {
		return array(
			'title' => 'Home/index',
			'body' => 'hello world'
		);
	}
}