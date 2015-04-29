<?php
	// File: index.php

	// Description: This page is an example of any unprotected page on the site. It will display
	// the user if it's logged in, otherwise a link to the login page.

	// Start authentication
	require_once("login.php");
	
	// Test user: testuser/password

	if (is_logged_in() != false)
	{
		echo "<p>Status: Logged in as ".$_SESSION['username'].". <a href=\"logout.php\">Log out</a>.</p>";
	}
	else
	{
		echo "<p>Status: Not logged in. <a href=\"login.php\">Log in</a>.</p>";
	}
?>

<br/>

<p>Displaying unprotected content. <a href="protected.php">Try loading a protected page.</a></p>

