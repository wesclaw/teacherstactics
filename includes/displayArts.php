<?php 

session_start();

require_once('../includes/dbh.inc.php');


if (!isset($_SESSION['user_id'])) {
  echo json_encode(['success' => false, 'error' => 'User not logged in']);
  exit;
}

$userId = $_SESSION['user_id'];

// Step 1: Fetch saved arts from the `users` table (from saved_arts column)
$sql = "SELECT saved_arts FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($savedArtsJson);
$stmt->fetch();
$stmt->close();

// Decode JSON to get an array of craft titles (not craft IDs)
$savedArts = !empty($savedArtsJson) ? json_decode($savedArtsJson, true) : [];

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
  echo json_encode(['success' => false, 'error' => 'JSON decoding error']);
  exit;
}

$arts = [];

// Step 2: Fetch details of each art based on the titles in saved_arts
if (!empty($savedArts)) {
  // Prepare placeholders in the query
  $placeholders = implode(',', array_fill(0, count($savedArts), '?'));
  $sql = "SELECT craft_id, title, description, materials
          FROM preschool_arts_and_crafts 
          WHERE title IN ($placeholders)"; // Looking for matching craft titles

  $stmt = $conn->prepare($sql);

  // Bind parameters dynamically based on the number of saved arts
  $types = str_repeat('s', count($savedArts));
  $stmt->bind_param($types, ...$savedArts);
  
  $stmt->execute();
  $result = $stmt->get_result();

  // Store each art as an associative array
  while ($row = $result->fetch_assoc()) {
      $arts[] = $row;
  }
  $stmt->close();
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'arts' => $arts]);