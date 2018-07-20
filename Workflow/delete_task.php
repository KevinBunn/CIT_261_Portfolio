<?php
/**
 * Created by PhpStorm.
 * User: kevinbunn
 * Date: 6/25/18
 * Time: 1:54 PM
 */

    session_start();

    require("dbConnect.php");
    $db = get_db();
    if (!isset($db)) {
        die("DB Connection was not set");
    }
    $taskId = $_POST['task'];

    $deleteTaskStmt = $db->prepare("DELETE FROM task WHERE task_id = :task_id");
    $deleteTaskStmt->bindValue(':task_id', $taskId, PDO::PARAM_INT);
    $deleteTaskStmt->execute();
?>