<?php include 'dbh.inc.php'?> 

<?php 
if (isset($_GET['getTotal'])) {
    $sql = "SELECT COUNT(*) as total FROM full_preschool_lesson_plans";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['total'];
    mysqli_close($conn);
    exit();
}

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;

$sql = "SELECT Id, Title, Description, CoverImage, Level FROM full_preschool_lesson_plans LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="plan.php?id=' . $row['Id'] . '" class="lesson-link">';
        echo '<div class="plan">';
        echo '<img src="' . htmlspecialchars($row['CoverImage']) . '" alt="Lesson Image" class="img-fluid coverImage" >';
        echo '<h3 class="title">' . htmlspecialchars($row['Title']) . '</h3>';
        echo '<p class="level">' . htmlspecialchars($row['Level']) . '</p>';
        echo '<p class="description">' . htmlspecialchars($row['Description']) . '</p>';
        echo '<div class="btn-holder">';
        echo '<button class="plan-btn">Show</button>';
        echo '<img src="icons/lock.png" class="img-fluid plan-lock">';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
} 

mysqli_close($conn);

?>






















