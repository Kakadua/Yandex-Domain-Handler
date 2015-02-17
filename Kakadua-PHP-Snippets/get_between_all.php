<?php
	/**
	 * Gets a substring between two other substrings. 
	 * 
	 * OBS, this returns all the matches,
	 * if you are only interested in the first one use get_between instead
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
	 * @param array $array An internal array, don't pass it in
	 *
	 * @return array The function returns the read data or FALSE on failure. 
	 *
	 *	@version 1
	 */
	function get_between_all($content, $start, $end, $array = array()){
		$temp = explode($start, $content, 2);
		if(isset($temp[1])){
			$temp = explode($end, $temp[1], 2);
			$array[] = $temp[0];
			return get_between_all($temp[1], $start, $end, $array);
		} else{
			return $array;
		}
	}
?>