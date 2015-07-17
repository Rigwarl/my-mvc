<?php

class html {
	static function nav($links, $class){
		global $url;

		$nav = "<ul class='$class'>";
		foreach ($links as $name => $link) {
			$active = (strpos($url, $link) === 0) ? " class='active'": '/';
			$link = rtrim($link, '/');
			$nav .= "<li$active><a href='/$link'>$name</a></li>";
		}
		$nav .= '</ul>';
		echo $nav;
	}
}