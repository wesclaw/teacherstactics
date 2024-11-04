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

        // Fetch the current saved_plans array for the user
        $stmt = $conn->prepare("SELECT saved_plans FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Decode the saved_plans array (assuming JSON format)
            $savedPlans = json_decode($row['saved_plans'], true);

            // Check if the title exists in the saved plans array
            if (($key = array_search($titleToRemove, $savedPlans)) !== false) {
                // Remove the title from the array
                unset($savedPlans[$key]);

                // Re-index array and convert back to JSON
                $savedPlans = array_values($savedPlans);
                $updatedSavedPlansJson = json_encode($savedPlans);

                // Update the user's saved_plans column in the database
                $updateStmt = $conn->prepare("UPDATE users SET saved_plans = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedSavedPlansJson, $userId);

                if ($updateStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Plan deleted successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update saved plans.']);
                }

                $updateStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Title not found in saved plans.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no saved plans available.']);
        }

        // Close statements
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Title not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}