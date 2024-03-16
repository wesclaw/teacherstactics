<?php
include("dbh.inc.php");

if (isset($_GET['id'])) {
    $lessonID = $_GET['id'];
    $sql = "SELECT Title FROM full_preschool_lesson_plans WHERE Id = $lessonID";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lessonTitle = $row['Title'];
    } else {
        $lessonTitle = "Lesson Not Found";
    }
} else {
  $lessonTitle = "Lesson ID not provided";
}
mysqli_close($conn);
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo htmlspecialchars($lessonTitle); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/plan.css">
  </head>
  <body>
    <?php include("includes/navbar.html") ?>
    <!-- This page will fetch from the database and display the plan based on the users click -->

    <?php
    include("dbh.inc.php");
     $sql = "SELECT Full_lesson FROM full_preschool_lesson_plans";

     // Executing the query
     $result = mysqli_query($conn, $sql);
 
     // Checking if there are any rows returned
     if (mysqli_num_rows($result) > 0) {
         // Fetching the result as an associative array
         $row = mysqli_fetch_assoc($result);
 
         // Storing the Full_lesson content in a variable
         $fullLesson = $row['Full_lesson'];
     } else {
         // If no rows are returned or Full_lesson is empty, set a default value
         $fullLesson = "No lesson available.";
     }
    ?>

    <div class="container">
    <div class="make-this-sticky">
    <button id="go_back_btn" class="back-btn"><img src="icons/back.png" alt="back btn">Back to plans</button>
  </div>
      <div class="sidebar">

      </div>
      <div class="plan">
        <p><?php echo $fullLesson; ?></p>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      const go_back_btn =document.getElementById('go_back_btn').addEventListener('click',()=>{
        window.history.back()
      })
    </script>
  </body>
</html>