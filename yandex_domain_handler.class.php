<?php
	/**
	 * Class for handling custom domains on Yandex
	 *
	 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
	 *
	 * @license https://raw.githubusercontent.com/Kakadua/Yandex-Domain-Handler/master/LICENSE The MIT License
	 *
	 * @link https://github.com/Kakadua/Yandex-Domain-Handler/
	 *
	 * @package Yandex-Domain-Handler
	 *
	 */

	error_reporting(0);

	//https://github.com/Kakadua/PHP-Snippets
	include('Kakadua-PHP-Snippets/get_between.php'); 
	include('Kakadua-PHP-Snippets/get_between_all.php'); 
	include('Kakadua-PHP-Snippets/string_contain.php');

	public class yandex_domain_handler {
		private var $username;
		private var $password;
		private var $signed_in;
		private var $raw;
		private var $ch;
		
		/**
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @version 1
		 */
		public function __construct() {						
			$this->signed_in = false;
		}

		/**
		 * Create a new account for one of your domains
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @param string $domain The domain you want to add the account to
		 * @param string $username The username you want the account to have
		 * @param string $password The password you want the account to have
		 *
		 * @return boolean Returns false if account could not be created or already exists otherwise true
		 *
		 * @version 1
		 */
		public function create_account($domain, $username, $password){
			$postfields = array(
				"domain" => $domain,
				"login" => $username,
				"password" => $password,
				"skey" => get_between($this->raw['constructor'], "skey':'", "'"),
				"search" => "",
				"show" => "",
				"page" => "",
				"limit" => "5"
			);
			$this->raw['create_account']  = $this->curl_post('https://domain.yandex.com/ajax/email_add.ajax.xml', $postfields);
			if(string_contain($this->raw['create_account'] , strtolower($username.'@'.$domain))){ return true; }
			else{	return false; }

		}

		/**
		 * Check if the instance is signed in to a Yandex account
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @return boolean Returns true if account is signed in
		 *
		 * @version 1
		 */
		public function is_signed_in(){
			return $this->signed_in;
		}

		/**
		 * Sign in to a Yandex account
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @param string $username The username for your Yandex admin account
		 * @param string $password The password for your Yandex admin account
		 *
		 * @return boolean Returns true if signed in otherwise false
		 *
		 * @version 1
		 */
		public function sign_in($username, $password){
			$this->username = $username;
			$this->password = $password;
			$postfields = array(
				"login" => $this->username,
				"passwd" => $this->password,
				"repath" => 'https://domain.yandex.com/domains_add/'
			);			
			$this->raw['constructor'] = $this->curl_post('https://passport.yandex.com/passport?mode=auth&retpath=https://domain.yandex.com/', $postfields);

			if(!string_contain($this->raw['constructor'], 'error-msg')){ $this->signed_in = true; return true; }
			else{	$this->signed_in =  false; return false; }	
		}

		/**
		 * Get the domains your account has
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @return array An array with your domains, example array('popeen.com', 'kakadua.net')
		 *
		 * @version 1
		 */
		public function get_domains(){
			return get_between_all($this->raw['constructor'], "Log in into mailbox for ", '"');
		}

		/**
		 * Make a POST request
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @return string The url you want to send the request to
		 * @return array The fields you want to send, example array('username' => 'Admin', 'Password' => 'MyAwsomePassword')
		 *
		 * @version 1
		 */
		private function curl_post($url, $postfields){
			curl_setopt($this->ch, CURLOPT_URL, $url);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie);
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie);
			curl_setopt($this->ch, CURLOPT_HEADER, false); 
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
			$p = "";
			foreach($postfields as $k=>$v) {	$p .= $k.'='.$v.'&'; }
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $p);
			return curl_exec($this->ch);
		}

	}
?>