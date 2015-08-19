<?php

class html {
	static function nav($links, $class){
		global $url;

		$nav = "<ul class='$class'>";
		foreach ($links as $name => $link) {
			$active = '';

			if (strpos('/' . $url, $link) === 0 && $link !== '/') {
				$active = " class='active'";
			}

			$nav .= "<li$active><a href='$link'>$name</a></li>";
		}
		$nav .= '</ul>';
		echo $nav;
	}
}