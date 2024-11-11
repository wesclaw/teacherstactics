<?php 

session_start();

require_once('../includes/dbh.inc.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the session
  $userId = $_SESSION['user_id'];

  // Get the JSON data from the request body
  $data = json_decode(file_get_contents('php://input'), true);
  $gameTitle = $data['url'];  // Assuming 'url' contains the game title in this case

  // Validate input
  if (isset($userId) && !empty($gameTitle)) {
      // Retrieve the current saved_arts value
      $stmt = $conn->prepare("SELECT saved_arts FROM users WHERE id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($savedArts);
      $stmt->fetch();
      $stmt->close();

      // Decode saved_arts into an array, or initialize an empty array if null/empty
      $savedArtsArray = !empty($savedArts) ? json_decode($savedArts, true) : [];

      // Add the new game title only if it doesn’t already exist in the array
      if (!in_array($gameTitle, $savedArtsArray)) {
          $savedArtsArray[] = $gameTitle; // Add the new game title
      }

      // Encode the updated array back to JSON format
      $updatedSavedArts = json_encode($savedArtsArray);

      // Update the saved_arts column with the new JSON value
      $updateStmt = $conn->prepare("UPDATE users SET saved_arts = ? WHERE id = ?");
      $updateStmt->bind_param("si", $updatedSavedArts, $userId);

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