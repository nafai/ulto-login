<?php
	// File: config.php
	//
	// Description: Config settings for this sample site. Does not modify headers or display
	// information to user.
	
	class Config
	{
		// Root path of main scripts
		const ROOT_PATH = '/location';
		
		// Root path of Google PHP Client Library (https://github.com/google/google-api-php-client)
		const GOOGLE_LIB_PATH = '/location';

		// Absolute path to user database (put in a location that can't be accessed by the httpd)
		const USERDB_LOCATION = '/location/users.sqlite3';

		// Absolute URI of the index page
		const INDEX_PAGE_URI = 'http://location/index.php';
		
		// Number of seconds after logging in that we'll auto-logout a user.
		// 300: 5 minutes; 3600: 1 hour.
		const LOGOUT_SECONDS = 300;

		// Google ID information (API access)
		const GOOGLE_CLIENT_ID = 'INSERT GOOGLE API CLIENT ID HERE';
 		const GOOGLE_CLIENT_SECRET = 'INSERT GOOGLE API CLIENT SECRET HERE';
 		const GOOGLE_REDIRECT_URI = 'http://location/login.php';
	}

	// Manually set time zone
	date_default_timezone_set('America/Toronto');

	// Google Authentication
	require_once(Config::GOOGLE_LIB_PATH . '/src/Google/autoload.php');
?>
