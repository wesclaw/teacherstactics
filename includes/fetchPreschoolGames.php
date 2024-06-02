<?php
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
        echo '<div class="line"></div>';
        echo '<div class="video-link">';
        echo $videoLink; 
        echo '</div>';
        echo '<div class="line"></div>';
        echo '<h5>Materials:</h5>';
        echo '<ul>';
        echo '<li>' . $gameMaterials . '</li>';
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
?>







