<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('../includes/dbh.inc.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['title'])) {
    $title = $data['title'];
    
    // Retrieve the user ID from the session
    $userId = $_SESSION['user_id'];

    // Build the SQL query to remove the title from the JSON array
    $sql = "
        UPDATE users 
        SET saved_plans = (
            SELECT JSON_ARRAYAGG(item) 
            FROM (
                SELECT item 
                FROM JSON_TABLE(saved_plans, '$[*]' COLUMNS (item VARCHAR(255) PATH '$')) AS jt
                WHERE item != ?
            ) AS subquery
        )
        WHERE user_id = ?";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $title, $userId);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Plan removed successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No changes made.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Title not provided.']);
}

$stmt->close();
$conn->close();