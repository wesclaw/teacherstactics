<?php 


session_start();


require_once('../includes/dbh.inc.php');


if (!isset($_SESSION['user_id'])) {
  echo json_encode(['success' => false, 'error' => 'User not logged in']);
  exit;
}

$userId = $_SESSION['user_id'];

// Step 1: Fetch saved experiments from the `users` table (from saved_experiments column)
$sql = "SELECT saved_experiments FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($savedExperimentsJson);
$stmt->fetch();
$stmt->close();

// Decode JSON to get an array of experiment titles
$savedExperiments = !empty($savedExperimentsJson) ? json_decode($savedExperimentsJson, true) : [];

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
  echo json_encode(['success' => false, 'error' => 'JSON decoding error']);
  exit;
}

$experiments = [];

// Step 2: Fetch details of each experiment based on the titles in saved_experiments
if (!empty($savedExperiments)) {
  // Prepare placeholders in the query
  $placeholders = implode(',', array_fill(0, count($savedExperiments), '?'));
  $sql = "SELECT experiment_id, title, description, materials
          FROM preschool_experiments 
          WHERE title IN ($placeholders)"; // Looking for matching experiment titles

  $stmt = $conn->prepare($sql);

  // Bind parameters dynamically based on the number of saved experiments
  $types = str_repeat('s', count($savedExperiments));
  $stmt->bind_param($types, ...$savedExperiments);
  
  $stmt->execute();
  $result = $stmt->get_result();

  // Store each experiment as an associative array
  while ($row = $result->fetch_assoc()) {
      $experiments[] = $row;
  }
  $stmt->close();
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'experiments' => $experiments]);