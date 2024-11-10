

<?php

session_start();

require_once('../includes/dbh.inc.php');

// Base paths for images and PDFs
$image_link = '/worksheet-images/';
$pdf_path = '/worksheet-pdfs/';

// Ensure the user ID is in the session
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];

// Step 1: Fetch saved worksheets URLs from the `users` table
$sql = "SELECT saved_worksheets FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($savedWorksheetsJson);
$stmt->fetch();
$stmt->close();

// Decode JSON to get an array of worksheet URLs
$savedWorksheets = !empty($savedWorksheetsJson) ? json_decode($savedWorksheetsJson, true) : [];

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'error' => 'JSON decoding error']);
    exit;
}

$worksheets = [];

// Step 2: Fetch details of each worksheet based on the URLs in saved_worksheets
if (!empty($savedWorksheets)) {
    // Prepare placeholders in the query
    $placeholders = implode(',', array_fill(0, count($savedWorksheets), '?'));
    $sql = "SELECT worksheet_id, title, pdf_link, image_path 
            FROM preschool_worksheets 
            WHERE pdf_link IN ($placeholders)";

    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically based on the number of saved worksheets
    $types = str_repeat('s', count($savedWorksheets));
    $stmt->bind_param($types, ...$savedWorksheets);
    
    $stmt->execute();
    $result = $stmt->get_result();

    // Store each worksheet as an associative array
    while ($row = $result->fetch_assoc()) {
        // Add full paths for images and PDFs
        $row['image_path'] = $image_link . $row['image_path'];
        $row['pdf_link'] = $pdf_path . $row['pdf_link'];
        $worksheets[] = $row;
    }
    $stmt->close();
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'worksheets' => $worksheets]);