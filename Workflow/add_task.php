<?php

require("dbConnect.php");
$db = get_db();
if (!isset($db)) {
    die("DB Connection was not set");
}

$project_id = $_GET['project'];

$taskName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
$priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_STRING);
$severity = filter_input(INPUT_POST, 'severity', FILTER_SANITIZE_STRING);
$category_id = filter_input(INPUT_POST, 'category-id', FILTER_SANITIZE_STRING);

try {
    $stmt = $db->prepare("INSERT INTO task (category_id, name, date_created, status, priority, severity) 
                                VALUES(:category_id, :name, :date_created, :status, :priority, :severity)");
    $timestamp = date('Y-m-d G:i:s');
    $stmt->bindValue(":category_id", intval($category_id), PDO::PARAM_INT);
    $stmt->bindValue(":name", $taskName, PDO::PARAM_STR);
    $stmt->bindValue(":date_created", $timestamp, PDO::PARAM_INT);
    $stmt->bindValue(":status", $status, PDO::PARAM_STR);
    $stmt->bindValue(":priority", intval($priority), PDO::PARAM_INT);
    $stmt->bindValue(":severity",intval($severity), PDO::PARAM_INT);

    $stmt->execute();
    header('Location: project.php?project=' . $project_id);
}
catch (PDOException $err) {
    $_SESSION['task_error'] = $err->getCode();
    header('Location: project.php?project=' . $project_id);
}
?>