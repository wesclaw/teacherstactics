

<?php //////////////////////////////remove this

// $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// $sql = "SELECT Id, Title, Description, CoverImage, Level FROM full_preschool_lesson_plans LIMIT 9 OFFSET $offset";

// $offset = isset($_GET['offset']);

///////////////////////// ?>

<?php include 'dbh.inc.php'; 

$sql = "SELECT Id, Title, Description, CoverImage, Level FROM full_preschool_lesson_plans";

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result); 

$results_per_page = 24;

   if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<a href="plan.php?id=' . $row['Id'] . '" class="lesson-link">'; 
      echo '<div class="plan">';
      echo '<img src="' . $row['CoverImage'] . '" alt="Lesson Image" class="img-fluid coverImage" >';
      echo '<h3 class="title">' . $row['Title'] . '</h3>';
      echo '<p class="level">' . $row['Level'] . '</p>';
      echo '<p class="description">' . $row['Description'] . '</p>';
      echo '<div class="btn-holder">';
      echo '<button class="plan-btn">Show</button>';
      echo '<img src="icons/lock.png" class="img-fluid plan-lock">';
      echo '</div>';
      echo '</div>'; 
      echo '</a>'; 
    }
  } 
  mysqli_close($conn);

 
