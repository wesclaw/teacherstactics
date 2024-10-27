<?php 

session_start();

require_once('../includes/dbh.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the POST request
    $currentPassword = trim($_POST['current_password']);
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validate input
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        echo "Please fill in all fields.";
        header("Location: /user/profile.php");
        exit;
    }

    // Check if new password matches confirmation
    if ($newPassword !== $confirmPassword) {
        echo "New password and confirmation do not match.";
        header("Location: /user/profile.php");
        exit;
    }

    // Fetch current user's stored password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?"); // Adjust based on your actual user_id
    $stmt->bind_param("i", $_SESSION['user_id']); // Assuming user_id is stored in session
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (!password_verify($currentPassword, $hashedPassword)) {
        echo "Current password is incorrect.";
        header("Location: /user/profile.php");
        exit;
    }

    // Hash the new password
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $updateStmt->bind_param("si", $newHashedPassword, $_SESSION['user_id']);
    
    if ($updateStmt->execute()) {
        echo "Password changed successfully.";
        header("Location: /user/profile.php");
    } else {
        echo "Error updating password: " . $updateStmt->error;
    }

    // Close the statements and connection
    $updateStmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}