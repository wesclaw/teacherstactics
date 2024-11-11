<?php


session_start();

require_once('../includes/dbh.inc.php');

header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (isset($data['title']) && !empty($data['title'])) {
        $titleToRemove = $data['title'];

        // Assuming you have the user's ID in session
        $userId = $_SESSION['user_id']; // Replace with appropriate user identification

        // Fetch the current saved_games array for the user
        $stmt = $conn->prepare("SELECT saved_games FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Decode the saved_games array (assuming JSON format)
            $savedGames = json_decode($row['saved_games'], true);

            // Check if the title exists in the saved games array
            if (($key = array_search($titleToRemove, $savedGames)) !== false) {
                // Remove the title from the array
                unset($savedGames[$key]);

                // Re-index array and convert back to JSON
                $savedGames = array_values($savedGames);
                $updatedSavedGamesJson = json_encode($savedGames);

                // Update the user's saved_games column in the database
                $updateStmt = $conn->prepare("UPDATE users SET saved_games = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedSavedGamesJson, $userId);

                if ($updateStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Game removed successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update saved games.']);
                }

                $updateStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Game title not found in saved games.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no saved games available.']);
        }

        // Close statements
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Game title not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}