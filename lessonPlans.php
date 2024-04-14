<?php include("dbh.inc.php");?>


<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>lesson Plans</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="icons/lesson.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/lessonPlan.css">
  </head>
  <body>
  <?php include("includes/navbar.html") ?>

  <?php 

  $sql = "SELECT Id, Title, Description, CoverImage, Level FROM full_preschool_lesson_plans";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result); 
  ?>
  
 <div class="container lesson-wrapper">
    <?php include("includes/sidebar.html")?>
    <div class="lesson-plan" id="lessonPlanContainer">
        <?php  
        if ($resultCheck > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="plan.php?id=' . $row['Id'] . '" class="lesson-link">'; // Link to plan.php with lesson ID as parameter
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
        } else {
            echo '<p>No lesson found.</p>';
        }
        mysqli_close($conn); 
        ?>
    </div>
</div>
    


 
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
