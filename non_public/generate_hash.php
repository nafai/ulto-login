<?php 
	// File: generate_hash.php
	//
	// Description: Run from the comand line with username and password as arguments. Will return
	// an INSERT statement to execute from SQLite3 to put a user in the databse.

	if (!isset($argv[0]))
		die("This must be run from the command line.");
	elseif (isset($argv[1]) && isset($argv[2]))
	{
		$username = $argv[1];
		$password = password_hash($argv[2],PASSWORD_BCRYPT);
		echo 'INSERT INTO "users"(username,userpassword) VALUES("'.$username.'","'.$password.'");'."\n";
	}
	else
		echo "Syntax: php generate_hash.php username password\n\n";
?>

