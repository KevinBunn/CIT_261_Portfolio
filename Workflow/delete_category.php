<?php 
    session_start();

    require("dbConnect.php");
    $db = get_db();
    if (!isset($db)) {
        die("DB Connection was not set");
    }

    $categoryId = $_GET['category'];
    $projectId = $_GET['project'];

    $deleteTaskStmt = $db->prepare("DELETE FROM task WHERE category_id = :category_id");
    $deleteTaskStmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $deleteTaskStmt->execute();
    
    $deleteCategoryStmt = $db->prepare("DELETE FROM category WHERE category_id = :category_id");
    $deleteCategoryStmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $deleteCategoryStmt->execute();

    header('Location: project.php?project=' . $projectId);
?>