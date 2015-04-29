<?php
	// File: login.php
	//
	// Description: Contains logic for authentication for a site. Uses PHP's bcrypt hasing
	// function to store passwords in an SQLite3 database. This should be the first file
	// included in any page where authentication is required. Once a user has been logged
	// in, the username and login time will be stored in session cookies. This can be extended
	// with more user information by simply adding more session cookies for things like
	// user real name, user ID, etc.

	require_once("config.php");
	require_once("login_functions.php");

	// Start of page execution here. Load session cookies:
	session_start();

	// Google code start. 
	// Snippets taken from https://github.com/google/google-api-php-client

	$client = newGoogleAPIClient();

	// If we have a Google access token, we can make requests, else we generate an authentication URL.
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
	}

	// Check for valid Google ID on return from Google's API
	if (isset($_GET['code'])) {
		// Authenticate return token
		$client->authenticate($_GET['code']);

		// Store access token in session cookie
		$_SESSION['access_token'] = $client->getAccessToken();
	}

	// If we're signed in we can go ahead and retrieve the ID token, which is part of the bundle of
	// data that is exchange in the authenticate step- we only need to do a network call if we have
	// to retrieve the Google certificate to verify it, and that can be cached.
	$token_data = null;
	if ($client->getAccessToken()) {
		// Access token for Google Authentication exists. Set the session cookie and retrieve token data (assuming valid).
		$_SESSION['access_token'] = $client->getAccessToken();
		$token_data = $client->verifyIdToken()->getAttributes();
		if (isset($token_data) && isset($token_data["payload"]["email"]))
		{
			// Login performed. Set session username to Google email address. Session username also makes is_logged_in() work. Set login time for auto-timeout.
			$_SESSION['username'] = $token_data["payload"]["email"];
			if (!isset($_SESSION['login_time']))
			{
				// Set login time only the first time a Google user is authenticated
				$_SESSION['login_time'] = time();
			}
		}
	}

	if (strpos(Config::GOOGLE_CLIENT_ID, "googleusercontent") == false) {
	 	die("Config error: Bad Google API settings. Please check config file.");
	}

	// End Google code.

	// Check for post variables for login (local authentication)
	if (count($_POST) > 0)
	{
		// Post variables for username and password: Attempt login using post results.
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			if (!attempt_login($username,$password))
			{
				show_login_form("Authentication failure: Bad username or password.","#FF0000");
			}
		}
	}

	// If this page is called directly, check for valid logins/display the login page.
	if (basename($_SERVER['SCRIPT_FILENAME']) == "login.php")
	{
		if (is_logged_in())
		{
			// User logged in. Send them to index.php.
			//echo "You are logged in as ".$_SESSION['username'].". <a href=\"logout.php\">Log out</a>.";
			header("Location: ".Config::INDEX_PAGE_URI);
			exit;
		}
		else
		{
			// Display login form
			show_strict_login_form();
		}
	}

?>
