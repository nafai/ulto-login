# Ulto-Login

Ulto-Login is a PHP application that fulfils the following requirements:

* PHP based login form
* Local database storage and local user authentication
* Google ID authentication
* Complete documentation
* Demonstrates use of classes and code reuse

### Changelog

0.1 - Initial release, submitted as test result.

### Requirements

Ulto-Login requires the following software:

* PHP: 5.5 or greater (required for bcrypt-based password hashing)
* SQLite3 with PHP bindings (required for local database)
* PHP JSON bindings (required by Google OAuth library)

### Unpacking

* Place contents of "src" directory in a subdirectory accessible via your web root. 
* Place contents of "non_public" directory somewhere outside of your web root.
* Get Google's Google PHP API Library from https://github.com/google/google-api-php-client and place it preferably somewhere outside of your web root.

### Configuration

The following configuration steps must be followed:

* Match all constants in config.php to proper file locations and API IDs
* Set LOGOUT_SECONDS in config.php to the number of seconds after a user has logged on to log them out. (300 seconds = 5 minutes; 3600 seconds = 1 hour, etc)

### Database

The database schema is located in non_public/schema.txt. Hashes can be generated with generate_hash.php.

*Sample users in included database: testuser (password: password) and asdf (password: asdf)*

### Sample pages

The index.php file shows a page that displays content regardless of if a user is logged in or not. The protected.php file is a demonstration of a page that is only displayed to logged in users.

### Implementation

For each page you want to include this library in, put this line in your header:

```PHP
require_once("login.php");
```

You can use the *is_logged_in()* method to determine a user's logged in state. *$_SESSION['username']* will retrieve a user's login name. For a Google account, this is an email address.

A simple modification to the code could be made if it's necessary to determine if a user is a Google account or a local account. Storing this in the database is a good idea, as user permissions could be set there as well.

### Attribution
* Login page template (including CSS) by Thibaut Courouble. Licensed under MIT license. Retrieved from http://www.cssflow.com/snippets/login-form on 2015-04-28.
* Some code samples from Google APIs Client Library for PHP by Google, Inc. Licensed under Apache license. Retrieved from https://github.com/google/google-api-php-client on 2015-04-28. 

### License

MIT
