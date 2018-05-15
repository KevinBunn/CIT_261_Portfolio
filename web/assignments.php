<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Kevin's Homepage</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
</head>
<body>

        <!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">CS313 Portfolio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  About Me
              </a>
              <div class="dropdown-menu p-4 text-muted">
                  <?php
                    $string = file_get_contents("text.json");
                    $json = json_decode($string, true);
                  
                    echo '<p>' . $json['AboutMeFirst']['text'] . '</p>';
                    echo '<p>' . $json['AboutMeSecond']['text'] . '</p>';
                   ?>
              </div>
              </li>
            <li class="nav-item active">
              <a class="nav-link" href="assignments.php">Assignments</a>
            </li>
          </ul>
        </div>
    </div>
</nav>
    
<!-- Main Text -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div id="content">
                <h1>Assignments</h1>
                <p><a href="prove03/">Shopping Cart</a></p>
            </div>
        </div>
    </div>
</div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript"  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    </script>
</body>
</html>