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
    $sql = "SELECT Full_lesson, Level, Games, time FROM full_preschool_lesson_plans";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fullLesson = $row['Full_lesson'];
        $Level = $row['Level']; 
        $time = $row['time'];
        $Games = $row['Games'];
    } else {
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
        <p class='topic-text'><b>Topic:</b></p>
        <h1 class='lesson-title'><?php echo $lessonTitle ?></h1>
        <p class='time-text'><b>Circle Time:</b> <?php echo $time?></p>
        <p class='lesson-level'><b>Level:</b> <?php echo $Level ?></p>


        <!-- <p class='materials-used'><b>Materials:</b> <a href="" class='link-for-materials'>See here</a></p> -->

        <div class="make-this-sticky">
        <p class='materials-used'><b>Materials:</b> <a href="" class='link-for-materials'>See here</a></p>
        </div>
        

        <div class="line"></div>

        <div class="circle-time">
          <img src="icons/circletime.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Circle Time</p>
        </div>

        <p class='full_lesson'><?php echo $fullLesson ?></p>

        <div class="circle-time">
          <img src="icons/movement.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Games</p>
        </div>

        <p class='full_lesson'><?php echo $Games?></p>
       

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      // 

      const go_back_btn = document.getElementById('go_back_btn').addEventListener('click',()=>{
        window.history.back()
      })

      // 

      // this code finds any sentence ending in ':' and then wrapping the whole sentence in <br> tags and then setting the sentences to a <b> tag.
      const full_lesson = document.querySelector('.full_lesson');
      const lessonText = full_lesson.textContent;
      const regex = /([^.!?:]*?:)(?=\s|$)/g;
      const modifiedText = lessonText.replace(regex, '<br><b>$1</b><br>');
      full_lesson.innerHTML = modifiedText;

      // const full_lessons = document.querySelectorAll('.full_lesson');

      // // Iterate over each element and apply modifications
      // full_lessons.forEach(full_lesson => {
      //     const lessonText = full_lesson.textContent;
      //     const regex = /([^.!?:]*?:)(?=\s|$)/g;
      //     const modifiedText = lessonText.replace(regex, '<br><b>$1</b><br>');
      //     full_lesson.innerHTML = modifiedText;
      // });
            
      // 
    </script>
  </body>
</html>