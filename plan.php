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
    $sql = "SELECT Full_lesson, lesson_titles FROM full_preschool_lesson_plans";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fullLesson = $row['Full_lesson'];
        $lessonTitles = $row['lesson_titles'];
    } else {
        $fullLesson = "No lesson available.";
        $lessonTitles = "No lesson titles available.";
    }
    ?>

    <div class="container">
    <div class="make-this-sticky">
    <button id="go_back_btn" class="back-btn"><img src="icons/back.png" alt="back btn">Back to plans</button>
  </div>
      <div class="sidebar">

      </div>
      <div class="plan">
        <h1><?php echo $lessonTitle ?></h1>
        <p>Circle time</p>
        <b><?php echo $lessonTitles?></b>


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