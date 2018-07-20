<?php 
    session_start();
    
?>

<html>
    <head>
      <link rel="stylesheet" type="text/css" href="styles.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body id="body">
  <div class="login-container">
    <h1 id="login-title">Signup</h1>
    <form class="front-page-form" action="add_user.php" method="post">
        <input class="custom-input" type="text" name="first-name" placeholder="First Name"><br>
        <input class="custom-input" type="text" name="last-name" placeholder="Last Name"><br>
        <input class="custom-input" type="text" name="username" placeholder="Username"><br>
        <input class="custom-input" type="password" name="password" placeholder="Password"><br>
        <input class="custom-input" type="password" name="password-confirm" placeholder="Password Confirm"><br>
        <input class="front-page-button" type="submit">
    </form>
    <?php
        if(isset($_SESSION['signup_error'])) {
            echo "<p style=\"color: red\">" . $_SESSION['signup_error'] . "</p>";
        }
    ?>
    </div>
</body>
</html>