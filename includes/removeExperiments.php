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

        // Fetch the current saved_experiments array for the user
        $stmt = $conn->prepare("SELECT saved_experiments FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Decode the saved_experiments array (assuming JSON format)
            $savedExperiments = json_decode($row['saved_experiments'], true);

            // Check if the title exists in the saved experiments array
            if (($key = array_search($titleToRemove, $savedExperiments)) !== false) {
                // Remove the title from the array
                unset($savedExperiments[$key]);

                // Re-index array and convert back to JSON
                $savedExperiments = array_values($savedExperiments);
                $updatedSavedExperimentsJson = json_encode($savedExperiments);

                // Update the user's saved_experiments column in the database
                $updateStmt = $conn->prepare("UPDATE users SET saved_experiments = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedSavedExperimentsJson, $userId);

                if ($updateStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Experiment removed successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update saved experiments.']);
                }

                $updateStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Experiment title not found in saved experiments.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no saved experiments available.']);
        }

        // Close statements
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Experiment title not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();