<?php 

session_start();
require_once('../includes/dbh.inc.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the user ID from the session
  $userId = $_SESSION['user_id']; // This should be set when the user logs in

  // Check if user ID is set
  if (isset($userId)) {
      // Begin a transaction
      $conn->begin_transaction();

      try {
          // Delete the user from the users table
          $deleteUserStmt = $conn->prepare("DELETE FROM users WHERE id = ?");
          $deleteUserStmt->bind_param("i", $userId);
          $deleteUserStmt->execute();

          // Commit the transaction
          $conn->commit();

          // Destroy the session and redirect the user to the registration page
          session_destroy();
          header("Location: ../pages/registration.php");
          exit;

      } catch (Exception $e) {
          // Rollback the transaction in case of error
          $conn->rollback();
          echo "Error deleting account: " . $e->getMessage();
      } finally {
          // Close statement
          $deleteUserStmt->close();
      }
  } else {
      echo "User not found.";
  }

  $conn->close();
} else {
  echo "Invalid request method.";
}