<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/27/2018
 * Time: 10:17 PM
 */
session_start();

require("dbConnect.php");
$db = get_db();
if (!isset($db)) {
    die("DB Connection was not set");
}

$taskId = $_POST['task'];
$status = $_POST['status'];

$updateTaskStmt = $db->prepare("UPDATE task SET status = :status WHERE task_id = :task_id");
$updateTaskStmt->bindValue(':task_id', $taskId, PDO::PARAM_INT);
$updateTaskStmt->bindValue(':status', $status, PDO::PARAM_STR);
$updateTaskStmt->execute();

?>