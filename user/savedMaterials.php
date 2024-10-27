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
    <title>Saved Materials</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/savedMaterials.css">
  </head>
  <body>

  <?php include('../bars/navbar.php')?>;



    <div class="container main">
    <p class="material-top-tag">Saved materials</p>
    <div class="wrapper-for-materials">
      <div class="left-side">
          <button class="active">
            <img src="../icons/saved_lessons.png" class="save_icon">
          Lessons
        </button>
          <button>
          <img src="../icons/saved_worksheets.png" class="save_icon">
          Worksheets
        </button>
          <button>
          <img src="../icons/saved_games.png" class="save_icon">
           Games</button>
          <button>
          <img src="../icons/saved_arts.png" class="save_icon">  
          Arts & Crafts</button>
          <button>
          <img src="../icons/saved_experiments.png" class="save_icon">  
          Experiments</button>
      </div>

      <div class="right-side">
        <h4 class="noMaterialsClass">You currently don't have any saved lessons</h4>
      </div>

      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='../js/savedMaterials.js' async defer></script>
  </body>
</html>