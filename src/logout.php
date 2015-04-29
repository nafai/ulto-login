<?php
	// File: logout.php
	//
	// Description: Displays a login form if user is not logged in. Otherwise, perform a logout and
	// notify the user.
	
	// Display login form or get session data with currently logged in user.
	require_once("login.php");

	// Execution resumes only if user is already logged in. Perform logout:
	logout();

	// User has been logged out. Display the HTML below.
?>

Status: Logged out. <a href="index.php">Return to login page</a>.
