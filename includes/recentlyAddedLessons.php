<?php
require_once('../includes/dbh.inc.php');
?>

<?php 
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 4;

$sql = "SELECT Id, Title, Description, CoverImage, Level 
        FROM full_preschool_lesson_plans 
        ORDER BY Id DESC 
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="../pages/plan.php?id=' . $row['Id'] . '" class="lesson-link">';
            echo '<div class="plan">';
            echo '<img src="../' . htmlspecialchars($row['CoverImage']) . '" alt="Lesson Image" class="img-fluid coverImage">';
            echo '<h3 class="title">' . htmlspecialchars($row['Title']) . '</h3>';
            echo '<p class="level">' . htmlspecialchars($row['Level']) . '</p>';
            echo '<p class="description">' . htmlspecialchars($row['Description']) . '</p>';
            echo '<div class="btn-holder">';
            echo '<button class="plan-btn">Show</button>';
            echo '<div class="icon-parent">';
            echo '<img src="../icons/unlock.png" class="img-fluid plan-lock hide-icon">';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    }
    
    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Handle statement preparation error
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
// mysqli_close($conn);














