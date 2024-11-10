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
      // Retrieve the current saved_games value
      $stmt = $conn->prepare("SELECT saved_games FROM users WHERE id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($savedGames);
      $stmt->fetch();
      $stmt->close();

      // Decode saved_games into an array, or initialize an empty array if null/empty
      $savedGamesArray = !empty($savedGames) ? json_decode($savedGames, true) : [];

      // Add the new game title only if it doesn’t already exist in the array
      if (!in_array($gameTitle, $savedGamesArray)) {
          $savedGamesArray[] = $gameTitle; // Add the new game title
      }

      // Encode the updated array back to JSON format
      $updatedSavedGames = json_encode($savedGamesArray);

      // Update the saved_games column with the new JSON value
      $updateStmt = $conn->prepare("UPDATE users SET saved_games = ? WHERE id = ?");
      $updateStmt->bind_param("si", $updatedSavedGames, $userId);

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

