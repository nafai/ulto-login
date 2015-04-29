<?php
  // File: loginform.php
  //
  // Description: Mostly HTML form that displays a login form to the user. Optionally passes
  // a message ($authentication_title) above the username field.
  //
  // Attribution: Page template (including CSS) by Thibaut Courouble. Licensed under MIT license. 
  // Retrieved from http://www.cssflow.com/snippets/login-form on 2015-04-28.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Authentication required</h1>
      <form method="post" action="login.php">
        <?php
          // Display message returned from login form above the username field.
          if (isset($authentication_title))
          {
            echo "<p style=\"color: $authentication_color;\">$authentication_title</p>";
          }
          else
          {
            echo "<p style=\"color: #000000;\">Please log in below.</p>";
          }
          
          if (isset($authUrl))
          {
            echo "<p style=\"color: #000000;\"><a href=\"$authUrl\">Log in with Google</a></p>";
          }
        ?>
        <p><input type="text" name="username" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <!--<p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>-->
    </div>
  </section>
</body>
</html>
