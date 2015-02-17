<?php
	include('yandex_domain_handler.class.php');

	$username 	= ''; //Username of admin account
	$password 	= ''; //Password of admin account 
	$domain 	= ''; //Domain to use

	$new_account_username = 'AccountName';		//Username for new account
	$new_account_password = 'MyAwsomePassword';	//Password for new account

	$ydh = new yandex_domain_handler();

	if($ydh-> sign_in($username, $password)){ //Sign in as admin for the custom domain.

		$domains = $ydh->get_domains(); //Get your domains.
		
		if($ydh-> create_account($domains[0], $new_account_username, $new_account_password)){ //Create a new account. Returns true if created successfully.
			echo 'The account was created';
		} else{ 
			echo 'There was an error when creating the account, maybe it already exists';
		}

	} else{
		echo 'Error, not signed in';
	}
?>