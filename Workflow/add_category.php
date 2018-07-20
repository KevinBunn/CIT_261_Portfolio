<?php 
  session_start();

  require("dbConnect.php");
  $db = get_db();
  if (!isset($db)) {
    die("DB Connection was not set");
  }

  $projectId = $_GET['project'];

  $categoryName = filter_input(INPUT_POST, 'category-name', FILTER_SANITIZE_STRING);

  function insertNewCategory($categoryName, $db, $projectId) {
    $timestamp = date('Y-m-d G:i:s');
    $stmt = $db->prepare("INSERT INTO category (project_id, name, date_created) VALUES (:project_id, :name, :date_created)");
    $stmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);
    $stmt->bindValue(':name', $categoryName, PDO::PARAM_STR);
    $stmt->bindValue(':date_created', $timestamp, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
  }

  try {
      $rowsAffected = insertNewCategory($categoryName, $db, $projectId);
      if ($rowsAffected == 0) {
          $_SESSION['category_error'] = "Nothing was inserted";
          header('Location: project.php?project=' . $projectId);
      }
      header('Location: project.php?project=' . $projectId);

    }
    catch (PDOException $err) {
      $_SESSION['category_error'] = $err->getMessage() . ' ' . $err->getCode();
      header('Location: project.php?project=' . $projectId);
    }
?>