<?php

require_once('../includes/dbh.inc.php');

$error = '';


if(empty($_POST["name"])){
  $error = 'Please enter in all the fields:)';
}

if( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  $error = 'Please enter in all the fields:)';
}

if(strlen($_POST["password"]) < 8) {
  $error = 'Please enter in all the fields:)';
}

if(!preg_match("/[a-z]/i", $_POST["password"]))
{
  $error = 'Please enter in all the fields:)';
}

if(!preg_match("/[0-9]/i", $_POST["password"]))
{
  $error = 'Please enter in all the fields:)';
}

if($_POST["password"] !== $_POST["repeat_password"]) {
  $error = 'Your password does not match:)';
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$sql = "INSERT INTO users (first_name, email, password) VALUES (?, ?, ?)";

$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
  die("SQL error: " . $conn->error);
}

$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);

// Execute the statement
if ($stmt->execute()) {

  session_start();
  
  $_SESSION['user_id'] = $stmt->insert_id; 
  $_SESSION['name'] = $_POST['name']; 
  $_SESSION['email'] = $_POST['email']; 
  /////////

  header("Location: /user/main.php"); 
  exit; 
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

