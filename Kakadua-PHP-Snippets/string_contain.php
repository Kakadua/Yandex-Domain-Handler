<?php
	/**
	 * Check if a string contains a substring
	 *
	 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
	 *
	 * @license https://raw.githubusercontent.com/Kakadua/PHP-Snippets/master/LICENSE Unlicense
	 *
	 * @link https://github.com/Kakadua/PHP-Snippets/
	 *
	 * @package Kakadua-PHP-Snippets
	 *
	 * @param String $string The full string
	 * @param String $substring The substring
	 *
	 * @return boolean Your string without the lines and tabs
	 *
	 *	@version 1
	 */
	function string_contain($string, $substring){
		if(strpos($string, $substring) !== FALSE){
			return true;
		}
		else{
			return false;
		}
	}
?>