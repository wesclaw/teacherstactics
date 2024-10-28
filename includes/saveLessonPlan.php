<?php 

session_start();

require_once('../includes/dbh.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the session
  $userId = $_SESSION['user_id'];

  // Get the JSON data from the request body
  $data = json_decode(file_get_contents('php://input'), true);
  $title = $data['title'];

  // Validate input
  if (isset($userId) && !empty($title)) {
      // Retrieve the current saved_plans value
      $stmt = $conn->prepare("SELECT saved_plans FROM users WHERE id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($savedPlans);
      $stmt->fetch();
      $stmt->close();

      // Decode saved_plans into an array, or initialize an empty array if null/empty
      $savedPlansArray = !empty($savedPlans) ? json_decode($savedPlans, true) : [];

      // Add the new title only if it doesn’t already exist in the array
      if (!in_array($title, $savedPlansArray)) {
          $savedPlansArray[] = $title; // Add the new title
      }

      // Encode the updated array back to JSON format
      $updatedSavedPlans = json_encode($savedPlansArray);

      // Update the saved_plans column with the new JSON value
      $updateStmt = $conn->prepare("UPDATE users SET saved_plans = ? WHERE id = ?");
      $updateStmt->bind_param("si", $updatedSavedPlans, $userId);

      if ($updateStmt->execute()) {
          // Success response
          echo json_encode(['success' => true]);
      } else {
          // Error response
          echo json_encode(['success' => false, 'error' => 'Database error: ' . $updateStmt->error]);
      }

      $updateStmt->close();
  } else {
      // Invalid input response
      echo json_encode(['success' => false, 'error' => 'Invalid input.']);
  }
} else {
  // Invalid request method response
  echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}

$conn->close();