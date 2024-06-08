<?php /*
require_once('../includes/dbh.inc.php');

$sql = "SELECT game_id, game_name, game_type, game_topic, description, video_link, game_materials, level FROM preschool_games";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $gameName = htmlspecialchars($row['game_name']);
        $gameType = htmlspecialchars($row['game_type']);
        $gameTopic = htmlspecialchars($row['game_topic']);
        $description = htmlspecialchars($row['description']);
        $videoLink = $row['video_link'];
        $gameMaterials = $row['game_materials'];
        $level = htmlspecialchars($row['level']);

        // Output HTML markup for each game
        echo '<div class="game">';
        echo '<div class="top-title">';
        echo '<h4 class="title">' . $gameName . '</h4>';
        echo '<button>';
        echo '<img src="../icons/star.png" class="star-icon">';
        echo '</button>';
        echo '</div>';       
        echo '<div class="video-link">';
        echo $videoLink; 
        echo '</div>';
        echo '<div class="line"></div>';
        echo '<h5>Materials:</h5>';
        echo '<ul>';
        echo $row['game_materials'];
        echo '</ul>';
        echo '<div class="line"></div>';
        echo '<h5>Game:</h5>';
        echo '<p>' . $description . '</p>';
        echo '</div>';
    }
} else {
    // No games found in the database
    echo "No games found.";
}

// Close database connection
mysqli_close($conn);


*/


require_once('../includes/dbh.inc.php');

$sql = "SELECT game_id, game_name, game_type, game_topic, description, video_link, game_materials, level FROM preschool_games";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $game_id, $game_name, $game_type, $game_topic, $description, $video_link, $game_materials, $level);

// Store result to get the number of rows
mysqli_stmt_store_result($stmt);

// Check if any rows are returned
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Fetch values and display them
    while (mysqli_stmt_fetch($stmt)) {
        $gameName = htmlspecialchars($game_name);
        $gameType = htmlspecialchars($game_type);
        $gameTopic = htmlspecialchars($game_topic);
        $description = htmlspecialchars($description);
        $videoLink = htmlspecialchars($video_link);
        $level = htmlspecialchars($level);

        // Output HTML markup for each game
        echo '<div class="game">';
        echo '<div class="top-title">';
        echo '<h4 class="title">' . $gameName . '</h4>';
        echo '<button class="btn">';
        echo '<img src="../icons/star.png" class="star-icon">';
        echo '<span class="hover-message">Add to favorites</span>';
        echo '</button>';
        echo '</div>';       
        echo '<div class="video-link">';
        echo $videoLink; 
        echo '</div>';
        echo '<div class="line"></div>';
        echo '<h5>Materials:</h5>';
        echo '<ul>';
        echo $game_materials;
        echo '</ul>';
        echo '<div class="line"></div>';
        echo '<h5>Game:</h5>';
        echo '<p>' . $description . '</p>';
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