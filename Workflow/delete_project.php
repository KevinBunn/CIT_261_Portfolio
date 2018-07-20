<?php 
    session_start();

    require("dbConnect.php");
    $db = get_db();
    if (!isset($db)) {
        die("DB Connection was not set");
    }

    $projectId = $_GET['project'];

    $getCategoriesStmt = $db->prepare("SELECT category_id FROM category WHERE project_id = :project_id");
    $getCategoriesStmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);
    $categories = $getCategoriesStmt->execute();

    foreach ($categories as $category) {
      $categoryId = $category["category_id"];
      
      $deleteTaskStmt = $db->prepare("DELETE FROM task WHERE category_id = :category_id");
      $deleteTaskStmt->bindValue(':category_id', categoryId, PDO::PARAM_INT);
      $deleteTaskStmt->execute();
    }

    $deleteCategoryStmt = $db->prepare("DELETE FROM category WHERE project_id = :project_id");
    $deleteCategoryStmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);
    $deleteCategoryStmt->execute();

    $deleteUserToProjectStmt = $db->prepare("DELETE FROM user_to_project WHERE project_id = :project_id");
    $deleteUserToProjectStmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);
    $deleteUserToProjectStmt->execute();

    $deleteProjectStmt = $db->prepare("DELETE FROM project WHERE project_id = :project_id");
    $deleteProjectStmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);
    $deleteProjectStmt->execute();

    header('Location: dashboard.php');
  
?>