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

    $project_id = $_GET['project'];
    echo '<script type="text/javascript">var jsUrl = "add_category.php?project=' . $project_id . '";</script>';
?>
<!DOCTYPE>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="projectView.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body id="body" onload="renderStatusColor()">
<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand" href="dashboard.php">Back To Dashboard</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a type="btn btn-sm" class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
  <div id="overlay" class="overlay"></div>
  <div id="overlay-form" class="overlay-form popup-container">
    <h1 id="login-title">Add Task</h1>
    <form class="popup-form" <?php echo 'action="add_task.php?project=' . $project_id . '"'?> method="post">
        <label for="name">Name: </label>
        <input class="custom-input" type="text" name="name"><br>
        <label for="status">Status: </label>
        <select class="custom-input" name="status">
          <option>Open</option>
          <option>Test</option>
          <option>Complete</option>
        </select><br>
        <label for="priority">Priority: </label>
        <select class="custom-input" name="priority">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select><br>
        <label for="severity">Severity: </label>
        <select class="custom-input" name="severity">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select><br>
        <div id="popup-button-row">
          <div onclick="closeOverlay()" class="front-page-button">Cancel</div>
          <input style="-webkit-appearance: push-button" class="front-page-button" type="submit">
        </div>
    </form>
  </div>
<div id="overlay-form-edit-task" class="overlay-form popup-container">
    <h1 id="login-title">Edit Task</h1>
    <form class="popup-form" <?php echo 'action="edit_task.php?project=' . $project_id . '"'?> method="post">
        <label for="name">Name: </label>
        <input id="edit-task-name-input" class="custom-input" type="text" name="name"><br>
        <label for="status">Status: </label>
        <select id="edit-task-status-input" class="custom-input" name="status">
            <option>Open</option>
            <option>Test</option>
            <option>Complete</option>
        </select><br>
        <label for="priority">Priority: </label>
        <select id="edit-task-priority-input" class="custom-input" name="priority">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select><br>
        <label for="severity">Severity: </label>
        <select id="edit-task-severity-input" class="custom-input" name="severity">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select><br>
        <div id="popup-button-row">
            <div onclick="closeEditTaskOverlay()" class="front-page-button">Cancel</div>
            <input style="-webkit-appearance: push-button" class="front-page-button" type="submit">
        </div>
    </form>
</div>
    <div class="content">
      <?php 
        $projectQuery = "SELECT name FROM project WHERE project_id = $project_id";
        $stmt = $db->prepare($projectQuery);
        $stmt->execute();
        $name = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo '<h1 id="project-page-title">' . $name[0]["name"] . '</h1>';
        
      ?>
      <div class="category-column">
        <?php 
        if(isset($_SESSION['category_error'])) {
            echo '<p>' . $_SESSION['category_error'] . '</p>';
        }
        if(isset($_SESSION['task_error'])) {
            echo '<p>'. $_SESSION['task_error'] . '</p>';
        }

        $category_query = "SELECT category_id, name, project_id FROM category WHERE project_id = $project_id";
        $stmt = $db->prepare($category_query);
        $stmt->execute();
        $categories = $stmt->fetchALL(PDO::FETCH_ASSOC);

        foreach($categories as $category) {
            $category_id = $category["category_id"];
            echo '<div class="category"><div class="category-top"><div class="category-title">' . $category["name"] . '</div><div class="dropdown"><div onclick="dropdown(' . $category_id . ')" class="dropbtn category-dropbtn">&#8942</div><div class="dropdown-content" id="dropdown-menu-' . $category_id . '"><a onclick="renderAddTask(' . $category_id . ')" href="#">Add Task</a><a href="delete_category.php?project=' . $project_id . '&category=' . $category_id . '">Delete Category</a></div></div></div>';

            $task_query = "SELECT * FROM task WHERE category_id = $category_id";
            if (!$task_stmt = $db->prepare($task_query)) {
                echo "prepare failed (" . $db->errno . ") " . $db->error;
            }
            if (!$task_stmt->execute()) {
                echo "Execute failed: (" . $task_stmt->errno . ") " . $task_stmt->error;
            }
            $tasks = $task_stmt->fetchALL(PDO::FETCH_ASSOC);
            if (count($tasks) > 0) {
                echo '<div class="task-header-row">
                        <div class="task-column-header"><span class="task-column-header-text">Name</span><img onclick="sortName(event)" class="sort-button" src="resources/sortButton.png"></div>  
                        <div class="task-column-header"><span class="task-column-header-text">Status</span><img onclick="sortName(event)" class="sort-button" src="resources/sortButton.png"></div>
                        <div class="task-column-header header-priority"><span class="task-column-header-text">Priority</span><img onclick="sortName(event)" class="sort-button" src="resources/sortButton.png"></div>
                        <div class="task-column-header header-severity"><span class="task-column-header-text">Severity</span><img onclick="sortName(event)" class="sort-button" src="resources/sortButton.png"></div>
                      </div>';
                echo '<div class="category-content">';
                foreach ($tasks as $task) {
                    echo '<div id="task-' . $task["task_id"] . '" class="task-wrapper">
                            <div class="task"><div class="task-content">
                            <div onclick="renderEditTask(' . $task["task_id"] . ',\'' . $task["name"] . '\',\'' . $task["status"] . '\',' . $task["priority"] . ',' . $task["severity"] . ')" class="task-cell task-name">' . $task["name"] . '</div>
                            <div class="task-cell task-status"><div class="task-status-cell-content"><span id="status-text-' . $task["task_id"] . '" class="task-status-text">' .  $task["status"] . '</span><div class="dropdown"><div onclick="dropdownTask(' . $task["task_id"] . ')" class="dropbtn">&#8942</div><div class="dropdown-content" id="dropdown-menu-status-' . $task["task_id"] . '"><a data-name="Open" onclick="updateStatus(' . $task["task_id"] . ', event)" href="#">Open</a><a data-name="Test" onclick="updateStatus(' . $task["task_id"] . ', event)" href="#">Test</a><a data-name="Complete" onclick="updateStatus(' . $task["task_id"] . ', event)" href="#">Complete</a></div></div></div></div>
                            <div onclick="renderEditTask(' . $task["task_id"] . ',\'' . $task["name"] . '\',\'' . $task["status"] . '\',' . $task["priority"] . ',' . $task["severity"] . ')" class="task-cell task-priority">' . $task["priority"] . '</div>
                            <div onclick="renderEditTask(' . $task["task_id"] . ',\'' . $task["name"] . '\',\'' . $task["status"] . '\',' . $task["priority"] . ',' . $task["severity"] . ')" style="border-right: 0px" class="task-cell task-severity">' . $task["severity"] . '</div></div></div>
                            <div class="task-delete"><img onclick="deleteTask(' . $task["task_id"] . ')" class="delete_icon" src="resources/delete_icon.png"></div>
                          </div>';
                }
                echo "</div>";
            }
            echo "</div>";
        }
        
        echo '<div class="category"><a id="add-category" class="category-title" href="#"><span>Add Category...</span></a></div>';

        ?>
      </div>
    </div>
</body>
</html>