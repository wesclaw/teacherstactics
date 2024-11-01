<?php


require_once('../includes/dbh.inc.php');

// Base paths for images and PDFs
$image_link = '/worksheet-images/';
$pdf_path = '/worksheet-pdfs/';

// Assume user ID is stored in the session
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

    while ($row = $result->fetch_assoc()) {
        $worksheets[] = $row; // Store each worksheet as an associative array
    }
    $stmt->close();
}