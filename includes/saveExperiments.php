<?php 

session_start();

require_once('../includes/dbh.inc.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the session
  $userId = $_SESSION['user_id'];

  // Get the JSON data from the request body
  $data = json_decode(file_get_contents('php://input'), true);
  $experimentTitle = $data['title'];  // Changed 'url' to 'title'

  // Validate input
  if (isset($userId) && !empty($experimentTitle)) {  // Changed $gameTitle to $experimentTitle
      // Retrieve the current saved_experiments value
      $stmt = $conn->prepare("SELECT saved_experiments FROM users WHERE id = ?");  // Changed column name to saved_experiments
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($savedExperiments);
      $stmt->fetch();
      $stmt->close();

      // Decode saved_experiments into an array, or initialize an empty array if null/empty
      $savedExperimentsArray = !empty($savedExperiments) ? json_decode($savedExperiments, true) : [];

      // Add the new experiment title only if it doesn’t already exist in the array
      if (!in_array($experimentTitle, $savedExperimentsArray)) {  // Changed $gameTitle to $experimentTitle
          $savedExperimentsArray[] = $experimentTitle; // Add the new experiment title
      }

      // Encode the updated array back to JSON format
      $updatedSavedExperiments = json_encode($savedExperimentsArray);

      // Update the saved_experiments column with the new JSON value
      $updateStmt = $conn->prepare("UPDATE users SET saved_experiments = ? WHERE id = ?");  // Changed column name to saved_experiments
      $updateStmt->bind_param("si", $updatedSavedExperiments, $userId);

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
