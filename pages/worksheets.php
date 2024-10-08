<?php

session_start(); 


if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: registration.php");
    exit;
}
?>

<?php
// worksheets.php

// Define a valid request path
$validPath = '/pages/worksheets.php';

// Get the current request path
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the request path is valid
if ($requestPath !== $validPath) {
    // If the request path is not valid, return a 404 response
    header("HTTP/1.1 404 Not Found");
    echo "404 Not Found";
    exit();
}

// Your normal script processing goes here
?>


<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Worksheets</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/worksheets.css">
  </head>
  <body>
  <?php include("../bars/navbar.php") ?>
  
  <div class="main-section">
  <?php include("../bars/worksheet_sidebar.php") ?>
  <div class="worksheet-wrapper">
      <?php include("../includes/fetchWorksheets.php")?>
  </div>
  </div>
  
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        const images = document.querySelectorAll('.worksheet-image');

        images.forEach(image => {
            image.addEventListener('load', function() {
                const worksheetDiv = image.parentElement.parentElement;
                worksheetDiv.classList.remove('worksheetLoad');
            });
        });

        const worksheetTitles = document.querySelectorAll('.worksheet-title');

        worksheetTitles.forEach((p_el)=>{
          p_el.classList.add('textLoad')
          images.forEach((img)=>{
            img.addEventListener('load',function(){
              p_el.classList.remove('textLoad')
            })
          })
        })
    });



    
  
    </script>
  </body>
</html>