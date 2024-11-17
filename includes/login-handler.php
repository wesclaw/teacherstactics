<?php
require_once('dbh.inc.php'); 

// require_once('includes/dbh.inc.php'); 
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email or password is empty
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please enter both email and password.";
        header("Location: /pages/login.php");
        exit;
    }

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
            $_SESSION['login_error'] = "The password is incorrect.";
            header("Location: /pages/login.php");
            exit;
        }
    } else {
        // Email does not exist
        $_SESSION['login_error'] = "This email does not exist.";
        header("Location: /pages/login.php");
        exit;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
