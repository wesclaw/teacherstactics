<?php
// Assume user ID is stored in the session
$userId = $_SESSION['user_id'];

// Step 1: Fetch saved plans from the `users` table
$sql = "SELECT saved_plans FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); // Bind user ID to prevent SQL injection
$stmt->execute();
$result = $stmt->get_result();

$savedPlans = [];
if ($row = $result->fetch_assoc()) {
    // Check if saved_plans is in JSON format
    $savedPlans = json_decode($row['saved_plans'], true);
    
    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Decode Error: " . json_last_error_msg();
    } else {
        // Clean up the titles
        $savedPlans = array_map(function($title) {
            return trim($title); // Just trim the whitespace, keep original format
        }, $savedPlans);
    }
}
$stmt->close();

// Debugging step: Verify saved plans
// Uncomment to see saved plans array

// Step 2: Fetch matching lesson plans from `full_preschool_lesson_plans`
$plans = [];
if (!empty($savedPlans)) {
    // Prepare the titles for the SQL IN clause
    $titles = implode(',', array_map(function($title) use ($conn) {
        return "'" . $conn->real_escape_string($title) . "'"; // Escape titles
    }, $savedPlans));


    $sql = "SELECT Id, Title, Description, CoverImage, Level 
            FROM full_preschool_lesson_plans 
            WHERE LOWER(TRIM(Title)) IN ($titles)";
    $result = $conn->query($sql);

    // Check for query error
    if (!$result) {
        die("Query Error: " . $conn->error); // Debugging step
    }

    while ($row = $result->fetch_assoc()) {
        $plans[] = $row; // Store each lesson plan as an associative array
    }
}