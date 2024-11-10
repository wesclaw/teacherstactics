<?php


session_start();

require_once('../includes/dbh.inc.php');

// Ensure the user ID is in the session
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];

// Step 1: Fetch saved games from the `users` table (from saved_games column)
$sql = "SELECT saved_games FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($savedGamesJson);
$stmt->fetch();
$stmt->close();

// Decode JSON to get an array of game titles (not URLs)
$savedGames = !empty($savedGamesJson) ? json_decode($savedGamesJson, true) : [];

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'error' => 'JSON decoding error']);
    exit;
}

$games = [];

// Step 2: Fetch details of each game based on the titles in saved_games
if (!empty($savedGames)) {
    // Prepare placeholders in the query
    $placeholders = implode(',', array_fill(0, count($savedGames), '?'));
    $sql = "SELECT game_id, game_name, description, game_materials
            FROM preschool_games 
            WHERE game_name IN ($placeholders)"; // Looking for matching game names

    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically based on the number of saved games
    $types = str_repeat('s', count($savedGames));
    $stmt->bind_param($types, ...$savedGames);
    
    $stmt->execute();
    $result = $stmt->get_result();

    // Store each game as an associative array
    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }
    $stmt->close();
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'games' => $games]);
