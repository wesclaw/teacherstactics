<?php




require_once('../includes/dbh.inc.php');

$sql = "SELECT craft_id, title, description, category_type, materials, instructions, age_group FROM preschool_arts_and_crafts";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $craft_id, $title, $description, $category_type, $materials, $instructions, $age_group);


// Store result to get the number of rows
mysqli_stmt_store_result($stmt);

// Check if any rows are returned
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Fetch values and display them
    while (mysqli_stmt_fetch($stmt)) {
      $title = htmlspecialchars($title);
      $description = htmlspecialchars($description);
      $instructions = htmlspecialchars($instructions);
      //////need to make the whitelist to allow a tags. I MUST USE HTMLSPECIALCHARS ON ALL THE FETCH FILES

      // Output HTML markup for each game
      echo '<div class="game">';
      echo '<div class="top-title">';
      echo '<h4 class="title">' . $title . '</h4>';
      echo '<button class="btn">';
      echo '<img src="../icons/star.png" class="star-icon">';
      echo '<span class="hover-message">Add to favorites</span>';
      echo '</button>';
      echo '</div>';       
      echo '<div class="line"></div>';
      echo '<h5>Materials:</h5>';
      echo '<ul>';
      echo $materials;
      echo '</ul>';
      echo '<div class="line"></div>';  
      echo '<h5>Description:</h5>';
      echo '<p>' . $description . '</p>';
      echo '<div class="btn-wrap">';
      echo '<button class="seemorebtn">see more</button>';
      echo '</div>';
      echo '</div>';
  }
} else {
  // No games found in the database
  echo "No games found.";
} 
// Close statement
mysqli_stmt_close($stmt);

// Close database connection
mysqli_close($conn);