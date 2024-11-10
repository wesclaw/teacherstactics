<?php 

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

function sanitizeContent($content) {
    // Define the pattern for allowed <a> tags pointing to the specific folder containing PDFs
    $link_pattern = '/<a\s+(?:[^>]*?\s+)?href="\/preschool_games_pdfs\/[^"]*\.pdf"[^>]*>(.*?)<\/a>/i';

    // Define the pattern for <li> tags containing allowed <a> tags
    $li_pattern = '/<li>(?:[^<]*<a\s+(?:[^>]*?\s+)?href="\/preschool_games_pdfs\/[^"]*\.pdf"[^<]*)<\/a>[^<]*<\/li>/i';

    // Sanitize <li> tags containing allowed <a> tags
    $sanitized_content = preg_replace_callback($li_pattern, function($match) {
        return $match[0];
    }, $content);

    // Remove any tags other than <a> and <li>
    $sanitized_content = strip_tags($sanitized_content, '<a><li>');

    // Ensure <a> tags have target="_blank"
    $sanitized_content = preg_replace_callback($link_pattern, function($match) {
        // Ensure that target="_blank" is included in the link
        if (strpos($match[0], 'target="_blank"') === false) {
            $match[0] = str_replace('<a ', '<a target="_blank" ', $match[0]);
        }
        return $match[0];
    }, $sanitized_content);

    return $sanitized_content;
}



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
        $game_materials= sanitizeContent($game_materials);

        // Output HTML markup for each game
        echo '<div class="game">';
        echo '<div class="top-title">';
        echo '<h4 class="title">' . $gameName . '</h4>';
        echo '<button class="btn save-game-btn">';
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
        echo '<p class="text-des">' . $description . '</p>';
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