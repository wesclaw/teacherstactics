<?php
require_once('../includes/dbh.inc.php'); 
?>

<?php
$sql = "SELECT worksheet_id, title, image_path, pdf_link 
FROM preschool_worksheets 
ORDER BY worksheet_id DESC 
LIMIT 6";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $worksheet_id, $title, $image_path, $pdf_link);
mysqli_stmt_store_result($stmt);

$image_link = '/worksheet-images/';
$pdf_path = '/worksheet-pdfs/';

if (mysqli_stmt_num_rows($stmt) > 0) {
while (mysqli_stmt_fetch($stmt)) {
    $title = htmlspecialchars($title);
    $image_path = htmlspecialchars($image_path);
    $pdf_link = htmlspecialchars($pdf_link);

    echo '<div class="worksheet worksheetLoad">';
    echo '<a href="' . $pdf_path . $pdf_link . '" target="_blank">';
    echo '<img loading="lazy" src="' . $image_link . $image_path . '" class="worksheet-image">';
    echo '<p class="worksheet-title">' . $title . '</p>';
    echo '</a>';
    echo '</div>';
}
} else {
echo "No worksheets found.";
}

mysqli_stmt_close($stmt);
} else {
echo "Error: " . mysqli_error($conn);  // Handle statement preparation error
}

// mysqli_close($conn);  // Close

