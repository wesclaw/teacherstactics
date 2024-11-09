<?php
session_start();

require_once('../includes/dbh.inc.php'); 

require_once('../includes/displayPlans.php');



////load dynamically here with js on click. when the worksheet btn is clicked, we fetch this file and display using ajax

// require_once('../includes/displayWorksheets.php');

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
        <!-- maybe here we shud have a new right-side for each btn. then call the fetch for each section on click. so right-side-lessons, right-side-worksheets, etc -->
        <?php if (!empty($plans)): ?>
    
          <?php foreach ($plans as $plan): ?>
          
          <a href="../pages/plan.php?id=<?php echo $plan['Id']; ?>" class="lesson-link">
          <div class="plan">
            <button class="deletePlan delete_worksheet_btn">
              <!-- <img src="../icons/delete2.png" class="icon-delete"> -->
              <img src="../icons/pinned-icon.png" class='delete-icon'>
            </button>
            <img src="../<?php echo $plan['CoverImage']; ?>" alt="Cover Image" class="coverImage">
            <h2 class="title"><?php echo htmlspecialchars($plan['Title']); ?></h2>
            
            <p class="level"><?php echo htmlspecialchars($plan['Level']); ?></p>
            <div class="btn-holder">
                <button class="plan-btn">Show</button>
                <div class="icon-parent">
                    <img src="../icons/unlock.png" class="img-fluid plan-lock hide-icon">
                </div>
            </div>
          </div>
          </a>  
            
        <?php endforeach; ?>
    
        <?php else: ?>
            <p>No saved lessons found.</p>
        <?php endif; ?>




        
        </div>

        <!-- right side worksheets -->

        <div class="right-side saved-worksheets">
          <!-- using fetch to get the includes file -->
        </div>
          <!--  -->
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='../js/savedMaterials.js' async defer></script>
  </body>
</html>