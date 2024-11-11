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

        // Fetch the current saved_arts array for the user
        $stmt = $conn->prepare("SELECT saved_arts FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Decode the saved_arts array (assuming JSON format)
            $savedArts = json_decode($row['saved_arts'], true);

            // Check if the title exists in the saved arts array
            if (($key = array_search($titleToRemove, $savedArts)) !== false) {
                // Remove the title from the array
                unset($savedArts[$key]);

                // Re-index array and convert back to JSON
                $savedArts = array_values($savedArts);
                $updatedSavedArtsJson = json_encode($savedArts);

                // Update the user's saved_arts column in the database
                $updateStmt = $conn->prepare("UPDATE users SET saved_arts = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedSavedArtsJson, $userId);

                if ($updateStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Art removed successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update saved arts.']);
                }

                $updateStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Art title not found in saved arts.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no saved arts available.']);
        }

        // Close statements
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Art title not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}