<?php
	// File: index.php

	// Description: This page is an example of a protected page on the site. It will only display
	// the content if the user is logged in. Otherwise, it will send them to the login page.

	// Start authentication
	require_once("login.php");
	
	// Test user: testuser/password

	if (is_logged_in() == false)
	{
		show_strict_login_form();
	}

	echo "<p>Status: Logged in as ".$_SESSION['username'].". <a href=\"logout.php\">Log out</a>.</p>";

?>

<br/>

<p>Displaying protected content.</p>

