<?php

session_start();


require_once('../includes/dbh.inc.php'); // Including the database connection


$error = ''; 

// Form validation logic

if (empty($_POST["name"])) {
    $error = 'Please enter your name.';
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $error = 'Please enter a valid email address.';
} elseif (strlen($_POST["password"]) < 8) {
    $error = 'Password must be at least 8 characters long.';
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $error = 'Password must contain at least one letter.';
} elseif (!preg_match("/[0-9]/i", $_POST["password"])) {
    $error = 'Password must contain at least one number.';
} elseif ($_POST["password"] !== $_POST["repeat_password"]) {
    $error = 'Passwords do not match.';
}

// If there are validation errors, store them in session and redirect back to the form
if (!empty($error)) {
  session_start(); // Ensure session is started
  $_SESSION['error'] = $error; // Store the error in session
  header("Location: ../pages/registration.php"); // Redirect back to the form
  exit(); 
}

// If no errors, proceed to hash the password and insert data into the database
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// SQL query to insert the new user into the database
$sql = "INSERT INTO users (first_name, email, password) VALUES (?, ?, ?)";

$stmt = $conn->stmt_init(); // Initialize the prepared statement

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $conn->error); // Handle SQL errors
}

// Bind the parameters and execute the statement
$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);

if ($stmt->execute()) {
    // If user was successfully inserted, store user info in session
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];

    // Redirect to the main user page
    header("Location: /user/main.php");
    exit(); // Stop further script execution
} else {
    echo "Error: " . $stmt->error; // Handle execution errors
}

// Close the statement and connection
$stmt->close();
$conn->close();