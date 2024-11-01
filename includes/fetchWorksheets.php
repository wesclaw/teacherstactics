<?php 

require_once('../includes/dbh.inc.php');

$sql = "SELECT worksheet_id, title, image_path, pdf_link FROM preschool_worksheets";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $worksheet_id, $title, $image_path, $pdf_link);

mysqli_stmt_store_result($stmt);

$image_link = '/worksheet-images/';
$pdf_path = '/worksheet-pdfs/';

if (mysqli_stmt_num_rows($stmt) > 0) {
    // Fetch values and display them
    while (mysqli_stmt_fetch($stmt)) {
        $title = htmlspecialchars($title);
        $image_path = htmlspecialchars($image_path);
        $pdf_link = htmlspecialchars($pdf_link);

        echo '<div class="worksheet worksheetLoad">';
        
        if (isset($_SESSION['user_id'])) {
            // User is logged in, create a direct link to the PDF
            echo '<a href="' . $pdf_path . $pdf_link . '" target="_blank">'; 
        } else {
            // User is not logged in, link to registration.php
            echo '<a href="../pages/registration.php">'; 
        }

        // echo '<a href="' . $pdf_path . $pdf_link . '" target="_blank">'; 

        
        echo '<img loading="lazy" src="' . $image_link . $image_path . '" class="worksheet-image">';
        echo '<p class="worksheet-title">' . $title . '</p>';
        echo '</a>';
        echo '</div>';
    }
} else {
    echo "No worksheets found.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);


