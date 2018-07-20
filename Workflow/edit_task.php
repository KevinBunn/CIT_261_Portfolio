<?php
/**
 * Created by PhpStorm.
 * User: kevinbunn
 * Date: 7/19/18
 * Time: 11:56 AM
 */

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
$task_id = filter_input(INPUT_POST, 'task-id', FILTER_SANITIZE_STRING);

try {
    $stmt = $db->prepare("UPDATE task SET status = :status, name = :name, severity = :severity, priority = :priority WHERE task_id = :task_id");
    $timestamp = date('Y-m-d G:i:s');
    $stmt->bindValue(":task_id", intval($task_id), PDO::PARAM_INT);
    $stmt->bindValue(":name", $taskName, PDO::PARAM_STR);
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