

<?php /* require_once('../includes/dbh.inc.php');
session_start();

if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $targetDirectory = "../uploads/";

    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    $filename = uniqid() . '-' . basename($file['name']);
    $targetFile = $targetDirectory . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {

        $userId = $_SESSION['user_id'];  

        $sql = "UPDATE users SET profile_img = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $targetFile, $userId);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "path" => $targetFile]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to save image path in database"]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to move uploaded file"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file was uploaded"]);
} 

*/?>

<?php require_once('../includes/dbh.inc.php');
session_start();

if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $targetDirectory = "../uploads/";

    // Create the uploads directory if it doesn't exist
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Get the user's ID from the session
    $userId = $_SESSION['user_id'];  

    // Step 1: Retrieve the last uploaded image path from the database
    $sql = "SELECT profile_img, last_uploaded_image FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $oldProfileImg, $lastUploadedImg);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Step 2: Delete the last uploaded image if it exists
    if ($lastUploadedImg && file_exists($lastUploadedImg)) {
        unlink($lastUploadedImg); // Remove the last uploaded image file from the server
    }

    // Step 3: Generate a unique filename for the new image
    $filename = uniqid() . '-' . basename($file['name']);
    $targetFile = $targetDirectory . $filename;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Step 4: Update the database with the new image path
        $sql = "UPDATE users SET profile_img = ?, last_uploaded_image = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $targetFile, $targetFile, $userId); // Bind the new paths

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "path" => $targetFile]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to save image path in database"]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to move uploaded file"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file was uploaded"]);
}




