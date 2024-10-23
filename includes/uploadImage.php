<?php require_once('../includes/dbh.inc.php');

session_start();

$data = json_decode(file_get_contents('php://input'), true);
$imagePath = $data['imagePath'] ?? '';

// Ensure the user is logged in and has a session
if (isset($_SESSION['user_id']) && $imagePath) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session

    // Update the profile_img field in the database
    $sql = "UPDATE users SET profile_img = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $imagePath, $userId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile image updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'No image path provided or user not logged in']);
}

