<?php

session_start();
require_once('../includes/dbh.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the session
  $userId = $_SESSION['user_id'];

  // Get the JSON data from the request body
  $data = json_decode(file_get_contents('php://input'), true);
  $worksheetUrl = $data['url'];  // Changed from 'title' to 'url' to match the worksheet URL

  // Validate input
  if (isset($userId) && !empty($worksheetUrl)) {
      // Retrieve the current saved_worksheets value
      $stmt = $conn->prepare("SELECT saved_worksheets FROM users WHERE id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($savedWorksheets);
      $stmt->fetch();
      $stmt->close();

      // Decode saved_worksheets into an array, or initialize an empty array if null/empty
      $savedWorksheetsArray = !empty($savedWorksheets) ? json_decode($savedWorksheets, true) : [];

      // Add the new worksheet URL only if it doesn’t already exist in the array
      if (!in_array($worksheetUrl, $savedWorksheetsArray)) {
          $savedWorksheetsArray[] = $worksheetUrl; // Add the new URL
      }

      // Encode the updated array back to JSON format
      $updatedSavedWorksheets = json_encode($savedWorksheetsArray);

      // Update the saved_worksheets column with the new JSON value
      $updateStmt = $conn->prepare("UPDATE users SET saved_worksheets = ? WHERE id = ?");
      $updateStmt->bind_param("si", $updatedSavedWorksheets, $userId);

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