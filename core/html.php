<?php

class html {
	static function nav($links, $class){
		global $url;

		$nav = "<ul class='$class'>";
		foreach ($links as $name => $link) {
			if ($link === $url) {
				$active = " class='active'";
			}
			$nav .= "<li$active><a href='$link'>$name</a></li>";
		}
		$nav .= '</ul>';
		echo $nav;
	}
}