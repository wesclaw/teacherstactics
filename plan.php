<?php

include("dbh.inc.php");

$lessonTitle = "Lesson Not Found"; // Default value

if (isset($_GET['id'])) {
    $lessonID = $_GET['id'];
    $sql = "SELECT Title, Description, CoverImage, Level, Full_lesson, Games, time, Books, Songs, Experiments, Projects, Arts_and_crafts, School_trips, Other_ideas FROM full_preschool_lesson_plans WHERE Id = $lessonID";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Assign retrieved values to variables
        $lessonTitle = $row['Title'];
        $Description = $row['Description'];
        $CoverImage = $row['CoverImage'];
        $Level = $row['Level'];
        $fullLesson = $row['Full_lesson'];
        $Games = $row['Games'];
        $time = $row['time'];
        $Books = $row['Books'];
        $Songs = $row['Songs'];
        $Experiments = $row['Experiments'];
        $Projects = $row['Projects'];
        $Arts_and_crafts = $row['Arts_and_crafts'];
        $School_trips = $row['School_trips'];
        $Other_ideas = $row['Other_ideas'];
    }
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
    <link rel="icon" href="icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Angkor&display=swap" rel="stylesheet">
    <!--  -->
    <link rel="stylesheet" href="styles/plan.css">
  </head>
  <body>
    <?php include("includes/navbar.html") ?>
   
    <div class="container">
      <div class="make-this-sticky">
          <button id="go_back_btn" class="back-btn"><img src="icons/back.png" alt="back btn">Back to plans</button>
      </div>
      <!--  -->
      <div class="sidebar">
        <div class="make-this" id="on-this-page">
        <h2>On This Page</h2>
        <div class="line"></div>
        <ul>
            <li><a href="#section1">Circle Time</a></li>
            <li><a href="#section2">Games</a></li>
            <li><a href="#section3">Books</a></li>
            <li><a href="#section4">Songs</a></li>
            <li class='link_for_experiments'><a href="#section5">Experiments</a></li>
            <li class='link_for_projects'><a href="#section6">Projects</a></li>
            <li><a href="#section7">Arts & Crafts</a></li>
            <li class="trip_text"><a href="#section8">Trips</a></li>
            <li class='link_for_other_ideas'><a href="#section9">Other Ideas</a></li>
            <li><a href="#section10">Worksheets</a></li>
            <!-- Add more links as needed -->
        </ul>
        </ul>
        </div>
        
      </div>

      <!--  -->
      <div class="plan">
        <p class='topic-text'><b>Topic:</b></p>
        <h1 class='lesson-title'><?php echo $lessonTitle ?></h1>
        <p class='time-text'><b>Circle Time:</b> <?php echo $time?></p>
        <p class='lesson-level'><b>Level:</b> <?php echo $Level ?></p>

        <div>
        <p class='materials-used'><b>Materials:</b> <a href="" class='link-for-materials'>See here</a></p>
        </div>
        
        <div class="line"></div>

        <div class="circle-time" id='section1'>
          <img src="icons/circletime.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Circle Time</p>
        </div>

        <p class='full_lesson'><?php echo $fullLesson ?></p>

        <div class="circle-time" id='section2'>
          <img src="icons/movement.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Games</p>
        </div>

        <p class='games-section'><?php echo $Games?></p>

        <div class="circle-time" id='section3'>
          <img src="icons/blue-book.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Books</p>
        </div>

       
        <div class='book-link-container'>
          <div class='flex'><?php echo $Books?></div>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section4'>
          <img src="icons/music.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Songs</p>
        </div>
        
        <div class='book-link-container'>
          <div class='flex'><?php echo $Songs?></div>
        </div>
        
        <div class="circle-time" style='margin-top: 20px;' id='section5'>
          <img src="icons/science2.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Experiments</p>
        </div>

        <div class='book-link-container' >
          <p class='games-section experiments_text'><?php echo $Experiments?></p>
        </div>

        <div class="circle-time" style='margin-top: 20px;'id='section6'>
          <img src="icons/projects.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Projects</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section project_text'><?php echo $Projects?></p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section7'>
          <img src="icons/art.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Arts & Crafts</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section'><?php echo $Arts_and_crafts?></p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section8'>
          <img src="icons/trips.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Trips</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section school_trips_text'><?php echo $School_trips?></p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section9'>
          <img src="icons/otherideas.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Other Ideas</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section otherIdeas'><?php echo $Other_ideas?></p>
        </div>

        <div class="circle-time" style='margin-top: 20px;'id='section10'>
          <img src="icons/worksheets.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Worksheets</p>
        </div>

      </div>
    </div>
    <!-- WORKSHEETS -->
    <section class='worksheets'>
      
      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/VETLettersWithS.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/bettervetletters-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>VET Display Letters with S</p>
        </a>
      </div>

      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/words_for_vet.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/vetwords-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>Words For The Letters VET</p>
        </a>
      </div>
      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/words_for_vet.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/vetwords-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>Words For The Letters VET</p>
        </a>
      </div>
      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/words_for_vet.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/vetwords-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>Words For The Letters VET</p>
        </a>
      </div>
      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/words_for_vet.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/vetwords-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>Words For The Letters VET</p>
        </a>
      </div>
      <div class="worksheet">
        <a href="preschool-worksheets/vet-pdfs/words_for_vet.pdf" class='a-tag-link' target="_blank">
        <img src="preschool-worksheets/vet-worksheets-images/vetwords-min.jpg" class="img-fluid worksheet_image" loading='lazy'>
        <p class='worksheet-title'>Words For The Letters VET</p>
        </a>
      </div>
      
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/plan.js"></script>
  </body>
</html>