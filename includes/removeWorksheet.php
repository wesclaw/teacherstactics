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

        // Fetch the current saved_worksheets array for the user
        $stmt = $conn->prepare("SELECT saved_worksheets FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Decode the saved_worksheets array (assuming JSON format)
            $savedWorksheets = json_decode($row['saved_worksheets'], true);

            // Check if the title exists in the saved worksheets array
            if (($key = array_search($titleToRemove, $savedWorksheets)) !== false) {
                // Remove the title from the array
                unset($savedWorksheets[$key]);

                // Re-index array and convert back to JSON
                $savedWorksheets = array_values($savedWorksheets);
                $updatedSavedWorksheetsJson = json_encode($savedWorksheets);

                // Update the user's saved_worksheets column in the database
                $updateStmt = $conn->prepare("UPDATE users SET saved_worksheets = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedSavedWorksheetsJson, $userId);

                if ($updateStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Worksheet deleted successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update saved worksheets.']);
                }

                $updateStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Worksheet title not found in saved worksheets.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no saved worksheets available.']);
        }

        // Close statements
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Title not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}