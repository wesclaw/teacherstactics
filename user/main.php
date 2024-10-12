<?php
session_start();

// Check if the user is signed up (by verifying if the session is active)
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/registration.php");
    exit;
}

?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/mainUserHomeFeed.css">
  </head>
  <body>

  <?php include('../bars/navbar.php')?>;

  <div class="container main">
    <div class="top-name">
    <?php 
        // Display the personalized greeting
        if (isset($_SESSION['name'])) { 
            echo "<h2>Hey, " . htmlspecialchars($_SESSION['name']) . ":)</h2>";
        } else {
            echo "<h2>Hey there!</h2>";
        }
        ?>
    </div>

    <h3 style="text-decoration: underline; margin-top: 20px; margin-bottom: 20px;" class="h3">Recently Added Lessons</h3>
    <div class="new-lessons">
      
      <?php include('../includes/recentlyAddedLessons.php'); ?>
    </div>
    <h3 class="h3" style="text-decoration: underline; margin-top: 20px; margin-bottom: 20px;">Recently Added Worksheets</h3>
    
    <div class="new-worksheets">
    <?php include('../includes/recentlyAddedWorksheets.php'); ?>
    </div>

       
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>