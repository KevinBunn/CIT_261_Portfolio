<?php 
    session_start();
    require("dbConnect.php");
    $db = get_db();
    if (!isset($db)) {
	   die("DB Connection was not set");
    }
?>
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body id="body">
  <div class="login-container">
    <h1 id="login-title">Login</h1>
    <form class="front-page-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input class="custom-input" type="text" name="username"  placeholder="Username"><br>
        <input class="custom-input" type="password" name="password" placeholder="Password"><br>
        <div id="button-row">
          <a class="front-page-button" href="signup.php">Signup</a>
          <input class="front-page-button" type="submit" value="Login">
        </div>
    </form>
    </div>

    <?php  

    $username = $_POST["username"];
    $stmt = $db->prepare('SELECT username, password FROM "user" WHERE username = :username');
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
  
    if (isset($_POST["username"]) && isset($_POST["password"])) {
      $successful_login = FALSE;
      foreach ($rows as $row) {
        if ($row["username"] == $_POST["username"] && password_verify($_POST["password"], $row["password"])) {
            $successful_login = TRUE;
        }
      }
      if($successful_login){
        $_SESSION["user"] = $_POST["username"];
        header('Location: dashboard.php');
      }
      else
        echo "<p style=\"color: red\">Username or Password is incorrect</p>";
    }
  ?>

</body>
</html>