<?php
include("dbh.inc.php");

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the 'id' value from the URL
    $lessonID = $_GET['id'];

    // Fetch the title of the lesson based on the 'id' from the database
    $sql = "SELECT Title FROM lessons WHERE Id = $lessonID";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // If a lesson with the provided ID is found, fetch the title
        $row = mysqli_fetch_assoc($result);
        $lessonTitle = $row['Title'];
    } else {
        // If no lesson with the provided ID is found, set a default title
        $lessonTitle = "Lesson Not Found";
    }
} else {
    // If 'id' parameter is not provided in the URL, set a default title
    $lessonTitle = "Lesson ID not provided";
}

// Close the database connection
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

    <div class="container">
    <div class="make-this-sticky">
    <button id="go_back_btn" class="back-btn"><img src="icons/back.png" alt="back btn">Back to plans</button>
  </div>
      <div class="sidebar">

      </div>
      <div class="plan">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere vero, libero tenetur illo voluptate, est incidunt esse, eaque dolore mollitia voluptatem aut exercitationem a alias! Alias, delectus? Veritatis necessitatibus animi fugiat id! Sapiente eaque cum, dolorum officiis placeat nostrum exercitationem enim! Sequi assumenda minus unde, labore nihil sit? At illum debitis consectetur in vel! Vero tempore magni molestias explicabo ipsa tempora non enim exercitationem tenetur doloremque eaque, eveniet adipisci fugiat optio saepe quasi aspernatur neque provident id quis incidunt labore eos deserunt? Itaque quibusdam doloremque non eligendi qui maxime vitae beatae similique dignissimos quas voluptates, nulla amet sint? Minus, repudiandae.</p>
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