<?php 

require_once('../includes/dbh.inc.php');



$sql = "SELECT worksheet_id, title, image_path, pdf_link FROM preschool_worksheets";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $worksheet_id, $title, $image_path, $pdf_link);

// Store result to get the number of rows
mysqli_stmt_store_result($stmt);

$image_link = '/worksheet-images/';
$pdf_path = '/worksheet-pdfs/';

// Check if any rows are returned
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Fetch values and display them
    while (mysqli_stmt_fetch($stmt)) {
        $title = htmlspecialchars($title);
        $image_path = htmlspecialchars($image_path);
        $pdf_link = htmlspecialchars($pdf_link);

        echo '<div class="worksheet">';
        echo '<a href="' . $pdf_path . $pdf_link . '" target="_blank">'; // Link to the PDF file
        echo '<img loading="lazy" src="' . $image_link . $image_path . '" class="worksheet-image">'; // Image path
        echo '<p>' . $title . '</p>'; // Title of the worksheet
        echo '</a>';
        echo '</div>';
    }
} else {
    // No worksheets found in the database
    echo "No worksheets found.";
}

// Close statement
mysqli_stmt_close($stmt);

// Close database connection
mysqli_close($conn);
