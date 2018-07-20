<?php
session_start();

require("dbConnect.php");
$db = get_db();
if (!isset($db)) {
   die("DB Connection was not set");
}

$firstName = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$passwordConfirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_STRING);

if(strcmp($password,$passwordConfirm) !== 0) {
    $_SESSION['signup_error'] = "passwords do not match";
    header('Location: signup.php');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

function insertNewUser($firstName, $lastName, $username, $password, $db) {
    $timestamp = date('Y-m-d G:i:s');
    $stmt = $db->prepare("INSERT INTO \"user\" (first_name, last_name, username, password, date_joined) VALUES(:firstname, :lastname, :username, :password, :timestamp)");
    $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':timestamp', $timestamp, PDO::PARAM_INT);
    $date = new DateTime();

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

try {
    $rowsAffected = insertNewUser($firstName, $lastName, $username, $hashedPassword, $db);
    if ($rowsAffected == 0) {
        $_SESSION['signup_error'] = "Nothing was inserted";
        header('Location: signup.php');
    }
    else
        header('Location: login.php');
}
catch (PDOException $err) {
    if ((int)$err->getCode() == 23505) {
        $_SESSION['signup_error'] = "Username is already taken";
        header('Location: signup.php');
    }
    else {
        $_SESSION['signup_error'] = $err->getCode();
        header('Location: signup.php');
    }
}
?>