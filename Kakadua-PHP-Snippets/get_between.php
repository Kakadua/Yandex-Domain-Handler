<?php
	/**
	 * Gets a substring between two other substrings. 
	 * 
	 * OBS, this function only gives you the first match, 
	 * if you want all of them use  get_between_all instead
	 *
	 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
	 *
	 * @license https://raw.githubusercontent.com/Kakadua/PHP-Snippets/master/LICENSE Unlicense
	 *
	 * @link https://github.com/Kakadua/PHP-Snippets/
	 *
	 * @package Kakadua-PHP-Snippets
	 *
	 * @param String $content The full string you want to check
	 * @param String $before The substring before the string you want
	 * @param String $after The substring after the string you want
	 *
	 * @return String The function returns the read data or FALSE on failure. 
	 *
	 *	@version 1
	 */
	function get_between($content, $before, $after){
		$temp = explode($before, $content);
		if (isset($temp[1])){
			$temp = explode($after, $temp[1]);
			return $temp[0];
		} else{
			return '';
		}
	}
?>