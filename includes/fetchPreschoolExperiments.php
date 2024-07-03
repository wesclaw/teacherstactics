<?php


require_once('../includes/dbh.inc.php');

// Define the SQL query to fetch data from the preschool_experiments table
$sql = "SELECT experiment_id, title, description, category_type, materials, instructions, age_group, duration, video_link FROM preschool_experiments";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $experiment_id, $title, $description, $category_type, $materials, $instructions, $age_group, $duration, $video_link);

// Store result to get the number of rows
mysqli_stmt_store_result($stmt);

// Check if any rows are returned
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Fetch values and display them
    while (mysqli_stmt_fetch($stmt)) {
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        
        $video_link = htmlspecialchars($video_link);

        // Output HTML markup for each experiment
        echo '<div class="game">';
        echo '<div class="top-title">';
        echo '<h4 class="title">' . $title . '</h4>';
        echo '<button class="btn">';
        echo '<img src="../icons/star.png" class="star-icon">';
        echo '<span class="hover-message">Add to favorites</span>';
        echo '</button>';
        echo '</div>';       
        echo '<div class="video-link">';
        echo $video_link; 
        echo '</div>';
        echo '<div class="line"></div>';
        echo '<h5>Materials:</h5>';
        echo '<ul>';
        echo $materials;
        echo '</ul>';
        echo '<div class="line"></div>';
        echo '<h5>Experiment:</h5>';
        echo '<p class="text-des">' . $description . '</p>';
        echo '</div>';
    }
} else {
    // No experiments found in the database
    echo "No experiments found.";
}

// Close statement
mysqli_stmt_close($stmt);

// Close database connection
mysqli_close($conn);
