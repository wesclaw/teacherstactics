<?php
require_once('dbh.inc.php'); // Include your database connection file
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc(); // Fetch user data
        
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id']; // Use the actual ID column name
            $_SESSION['name'] = $user['first_name']; // Adjust based on your DB
            $_SESSION['email'] = $user['email'];

            // Redirect to the user's main page
            header("Location: /user/main.php");
            exit;
        } else {
            // Password is incorrect
            header("Location: /pages/login.php");
            echo "this password is incorrect";
            exit; /// Use an alert for feedback
        }
    } else {
      header("Location: /pages/login.php");
      echo "this email does not exist";
      exit; 
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
