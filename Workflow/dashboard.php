<?php 
    session_start();
    if(isset($_SESSION['user']) === FALSE) {
       header('Location: login.php');
    }
    else if ($_SESSION['user'] == "") {
      header('Location: logout.php');
    }

    require("dbConnect.php");
    $db = get_db();
    if (!isset($db)) {
	   die("DB Connection was not set");
    }

    if (isset($_POST["project-name"])) {
        header('Location: add_project.php');
    }
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="dashboard.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body id="body">
  
  <nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand" href="#">Dashboard for
    <?php echo $_SESSION['user']; ?></a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a type="btn btn-sm" class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
    <div class="project-row">
  <?php 
    $current_username = $_SESSION['user'];
  
    $stmt = $db->prepare("SELECT p.project_id, name FROM project p INNER JOIN user_to_project ua ON ua.project_id = p.project_id INNER JOIN \"user\" u ON u.user_id = ua.user_id WHERE u.username = '$current_username';");
    $stmt->execute();
    $projects = $stmt->fetchALL(PDO::FETCH_ASSOC);
  
    //var_dump($projects);
    
    foreach ($projects as $project) {
      echo '<div data-project-id="' . $project["project_id"] . '" class="project"><div class="project-top"><a class="project-title-link" href="project.php?project=' . $project["project_id"] . '">' . $project["name"] . '</a>
      <a href="delete_project.php?project=' . $project["project_id"] . '">X</a>
      </div></div>';
    }
    
    echo '<div class="project"><a id="add-project" class="add-project-link" href="#"><span>create new project...</span></a></div>';
    
  ?>
    </div>
    <?php
        if (isset($_SESSION['dashboard_error'])) {
            echo "<p>" . $_SESSION['dashboard_error'] . "</p>";
        }
                if (isset($_SESSION['test'])) {
            echo $_SESSION['test'];
        }
    ?>
</body>
</html>