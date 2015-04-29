<?php
	// File: login_functions.php
	//
	// Description: Functions used by login.php for authentication.


	// Try to log in user with a given username and password. If this succeeds, set session
	// variables for username and login time and return true. If not, return false.
	function attempt_login($username,$password)
	{
		// Call validate_user() and store user info as session variables.
		if (validate_user($username,$password))
		{
			$_SESSION['username'] = $username;
			$_SESSION['login_time'] = time();
			return true;
		}
		else
		{
			// Authentication failure
			return false;
		}
	}

	function validate_user($username, $password)
	{
		
		$username = SQLite3::escapeString($username);

		$handle = new SQLite3(Config::USERDB_LOCATION);
		$query = "SELECT userPassword FROM users WHERE userName = '$username' LIMIT 1;";

		$query_result = $handle->querySingle($query);

		if (count($query_result) == 0)
		{
			// Invalid username
			return false;
		}
		elseif (password_verify($password,$query_result)) 
		{
			// Valid username, valid password
			return true;
		}
		else
		{
			// Valid username, invalid password
			return false;
		}
	}

	function newGoogleAPIClient()
	{
		$client = new Google_Client();
		$client->setClientId(Config::GOOGLE_CLIENT_ID);
		$client->setClientSecret(Config::GOOGLE_CLIENT_SECRET);
		$client->setRedirectUri(Config::GOOGLE_REDIRECT_URI);
		$client->setScopes('email');
		return $client;	
	}

	function logout_expired_users()
	{
		if (isset($_SESSION['login_time']))
		{
			// Check to see if user should still be logged on.
			if (time() > $_SESSION['login_time'] + Config::LOGOUT_SECONDS)
			{
				// Log out user
				logout();

				// Display login page immediately
				show_login_form("You have been logged out due to inactivity.","#000000");
				exit;
			}
		}
	}

	function show_login_form($message,$color)
	{
		// Set message before login box, and Google authentication URL
		$authentication_title = $message;
		$authentication_color = $color;
		$authUrl = generate_auth_url(newGoogleAPIClient());

		// Show login form with these local variables in scope
		include "loginform.php";
		exit;
	}

	function generate_auth_url($client)
	{
		// Manually regenerate client instance in order to get fresh client auth URL every time
		return newGoogleAPIClient()->createAuthUrl();
	}

	function is_logged_in()
	{
		logout_expired_users();

		// Check for already-applied username from 
		if (isset($_SESSION['username']))
		{
			// Return username
			return true;
		}
		else
		{
			// User is not logged in.
			return false;
		}
	}

	// Show login form and immediately exit.
	function show_strict_login_form()
	{
		show_login_form("Please log in.","#000000");
		exit;
	}

	function logout()
	{
		// Destroy old session cookies and start new ones.
		session_destroy();
		session_start();
	}

?>