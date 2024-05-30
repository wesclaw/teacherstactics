<?php include 'dbh.inc.php'?> 

<?php 

if (isset($_GET['getTotal'])) {
    $sql = "SELECT COUNT(*) as total FROM full_preschool_lesson_plans";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['total'];
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    exit();
}

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;

// Use prepared statements to prevent SQL injection
$sql = "SELECT Id, Title, Description, CoverImage, Level FROM full_preschool_lesson_plans LIMIT ? OFFSET ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result) {
        // Fetch results
        while ($row = mysqli_fetch_assoc($result)) {
            // Process results
            // For example, you can echo or manipulate $row data here
            echo '<a href="plan.php?id=' . $row['Id'] . '" class="lesson-link">';
            echo '<div class="plan">';
            echo '<img src="' . htmlspecialchars($row['CoverImage']) . '" alt="Lesson Image" class="img-fluid coverImage" >';
            echo '<h3 class="title">' . htmlspecialchars($row['Title']) . '</h3>';
            echo '<p class="level">' . htmlspecialchars($row['Level']) . '</p>';
            echo '<p class="description">' . htmlspecialchars($row['Description']) . '</p>';
            echo '<div class="btn-holder">';
            echo '<button class="plan-btn">Show</button>';
            echo '<img src="icons/unlock.png" class="img-fluid plan-lock">';
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
mysqli_close($conn);


















