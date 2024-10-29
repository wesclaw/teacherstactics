<?php
session_start();
require_once('../includes/dbh.inc.php'); // Database connection

// Assume user ID is stored in the session
$userId = $_SESSION['user_id'];

// Step 1: Fetch saved plans from the `users` table
$sql = "SELECT saved_plans FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); // Bind user ID to prevent SQL injection
$stmt->execute();
$result = $stmt->get_result();

$savedPlans = [];
if ($row = $result->fetch_assoc()) {
    // Check if saved_plans is in JSON format
    $savedPlans = json_decode($row['saved_plans'], true);
    
    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Decode Error: " . json_last_error_msg();
    } else {
        // Clean up the titles
        $savedPlans = array_map(function($title) {
            return trim($title); // Just trim the whitespace, keep original format
        }, $savedPlans);
    }
}
$stmt->close();

// Debugging step: Verify saved plans
// Uncomment to see saved plans array

// Step 2: Fetch matching lesson plans from `full_preschool_lesson_plans`
$plans = [];
if (!empty($savedPlans)) {
    // Prepare the titles for the SQL IN clause
    $titles = implode(',', array_map(function($title) use ($conn) {
        return "'" . $conn->real_escape_string($title) . "'"; // Escape titles
    }, $savedPlans));


    $sql = "SELECT Id, Title, Description, CoverImage, Level 
            FROM full_preschool_lesson_plans 
            WHERE LOWER(TRIM(Title)) IN ($titles)";
    $result = $conn->query($sql);

    // Check for query error
    if (!$result) {
        die("Query Error: " . $conn->error); // Debugging step
    }

    while ($row = $result->fetch_assoc()) {
        $plans[] = $row; // Store each lesson plan as an associative array
    }
}

// Display the lesson plans
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
        <!-- <h4 class="noMaterialsClass">You currently don't have any saved lessons</h4> -->
        <?php if (!empty($plans)): ?>
    
          <?php foreach ($plans as $plan): ?>
          
          <a href="../pages/plan.php?id=<?php echo $plan['Id']; ?>" class="lesson-link">
          <div class="plan">
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
        <p>No saved materials found.</p>
    <?php endif; ?>
      </div>

      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='../js/savedMaterials.js' async defer></script>
  </body>
</html>