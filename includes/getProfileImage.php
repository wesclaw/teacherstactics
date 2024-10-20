<?php require_once('dbh.inc.php'); 


// session_start();


$profileImageUrl = "../icons/man1.png"; // Default image

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session
    $sql = "SELECT profile_img FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profileImageUrl = $row['profile_img']; // Get the image URL from the database
        }
    }

    $stmt->close();
}

// $conn->close(); 
