<?php
/*
 * Plugin Name: The Enforcer
 * Plugin URI: http://explosm.net/rcg
 * Description: Enforce Admin and Author access to private HR Connect posts with a DDT. WHHHOOOOOOO!!!!!
 * Version: v1.0
 * Author: Arn Anderson
 * Author URI: http://en.wikipedia.org/wiki/Arn_Anderson
 */

add_filter('the_content', 'tfr_the_content');

function tfr_the_content($content) {
	$user = wp_get_current_user();
	$allowed_roles = array('editor','administrator');
	$allowed_access = '';

	if (array_intersect($allowed_roles, $user->roles )) {
		$allowed = true;
	}
	else {
		$allowed = false;
	};
	
	if (is_page(2055)) {
		if ($allowed == true) {
			return $content;
		}
		else {
			return '<br><br><br><br><span style="text-align: center"><h2>You are not authorized to view this page :(</h2></span><br><br><br><br>';
		}
	}
	if (is_page(365)) {
		if ($allowed == true) {
			$find = '<div id="hrcBtn"></div>';
			$replace = '<div id="hrcBtn">[su_button url="/?page_id=429" style="ghost" background="#2ea3f2" color="#2ea3f2" size="8" center="yes" radius="0" icon="icon: file-text-o" icon_color="#2ea3f2" class="theButton"]Create an HR Connect Post[/su_button]</div>';
			
			$sContent = str_replace($find, $replace, $content);
			
			return $sContent;
		}
		else {
			return $content;
		}
	}
	else {
		return $content;
	}
}
?>