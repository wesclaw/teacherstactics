<?php
session_start();

// Include the database connection
require_once('../includes/dbh.inc.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the values from the POST request
  $firstName = trim($_POST['first_name']);
  $email = trim($_POST['email']);

  // Validate input
  if (empty($firstName) || empty($email)) {
      // Handle error: empty fields
      echo "Please fill in all fields.";
      exit;
  }

  // Optionally, you can validate the email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Handle error: invalid email format
      echo "Invalid email format.";
      exit;
  }

  // Prepare SQL statement to prevent SQL injection
  $stmt = $conn->prepare("UPDATE users SET first_name = ?, email = ? WHERE id = ?"); // Adjust the table name and condition accordingly
  $stmt->bind_param("ssi", $firstName, $email, $_SESSION['user_id']); // Assuming you store user_id in session

  // Execute the statement
  if ($stmt->execute()) {
      // Update successful
      $_SESSION['name'] = $firstName;
      $_SESSION['email'] = $email;
      echo "Profile updated successfully.";
      header("Location: /user/profile.php");
  } else {
      // Handle error
      echo "Error updating profile: " . $stmt->error;
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
} else {
  // Not a POST request
  echo "Invalid request method.";
}