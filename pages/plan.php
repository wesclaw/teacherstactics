

<?php  
require_once('../includes/dbh.inc.php');

$lessonTitle = "Lesson Not Found"; 
$Description = "";
$CoverImage = "";
$Level = "";
$fullLesson = "";
$Games = "";
$time = "";
$Books = "";
$Songs = "";
$Experiments = "";
$Projects = "";
$Arts_and_crafts = "";
$School_trips = "";
$Other_ideas = "";

if (isset($_GET['id'])) {
    $lessonID = intval($_GET['id']);  
    
    if ($lessonID > 0) {
        $sql = "SELECT Title, Description, CoverImage, Level, Full_lesson, Games, time, Books, Songs, Experiments, Projects, Arts_and_crafts, School_trips, Other_ideas FROM full_preschool_lesson_plans WHERE Id = ?"; 

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $lessonID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $lessonTitle, $Description, $CoverImage, $Level, $fullLesson, $Games, $time, $Books, $Songs, $Experiments, $Projects, $Arts_and_crafts, $School_trips, $Other_ideas);
            if (!mysqli_stmt_fetch($stmt)) {
                $lessonTitle = "Lesson Not Found"; 
            }
            mysqli_stmt_close($stmt);
        } else {
            error_log("Database prepare statement error: " . mysqli_error($conn));
            echo "An error occurred. Please try again later.";
        }
    } else {
        error_log("Invalid lesson ID: " . $_GET['id']);
        echo "Invalid lesson ID.";
    }
}

mysqli_close($conn); 
?>

<!DOCTYPE html>

<html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo htmlspecialchars($lessonTitle); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Angkor&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/plan.css">
  </head>
  <body>
    <?php include("../bars/navbar.php") ?>
   
    <div class="container">
      <div class="make-this-sticky">
          <button id="go_back_btn" class="back-btn"><img src="../icons/back.png" alt="back btn">Back to plans</button>
      </div>

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
           
        </ul>
        </ul>
        </div>
        
      </div>
      
      <div class="plan">
        
      <div class="top-part">
          <button class="bookmark-btn like-btn">
            <img src="../icons/white-bookmark.png" class="bookmark-icon">
          </button>
          <div class="like-btns">
          <button class="like-btn">
            <img src="../icons/like.png" class="bookmark-icon">
          </button>
          <button class="unlike-btn">
          <img src="../icons/unlike.png" class="bookmark-icon">
          </button>
          </div>
      </div>
          
          

        
        <p class='topic-text'>
          <b>Topic:</b>
        </p>
        <h1 class='lesson-title'>
          
          <?php echo htmlspecialchars($lessonTitle)?>
        </h1>
        <p class='time-text'>
          <b>Circle Time:</b> 
          
          <?php echo htmlspecialchars($time)?>
        </p>
        <p class='lesson-level'>
          <b>Level:</b> 
         

          <?php echo htmlspecialchars($Level)?>
        </p>

        <div>
        <p class='materials-used'><b>Materials:</b> <a href="#materials" class='link-for-materials'>See here</a></p>
        </div>
        
        <div class="line"></div>

        <div class="circle-time" id='section1'>
          <img src="../icons/circletime.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Circle Time</p>
        </div>


        <?php 
            function sanitizeContent($content) {
              
              $pattern = '/<a\s+(?:[^>]*?\s+)?href="(?:https?:\/\/(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)|\/watch\?v=)[^"]*"[^>]*>(.*?)<\/a>/i';
          
              $sanitized_content = preg_replace_callback($pattern, function($match) {
                
                  return $match[0];
              }, $content);
              $sanitized_content = strip_tags($sanitized_content, '<a>');
              $sanitized_content = htmlspecialchars_decode($sanitized_content);
          
              return $sanitized_content;
          }
          $fullLesson = sanitizeContent($fullLesson);
        ?>
        <div class='full_lesson'>
        <?php echo $fullLesson; ?>
        </div>

        <div class="circle-time" id='section2'>
          <img src="../icons/movement.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Games</p>
        </div>

        <?php 
            function sanitizeGames($content) {
              
              $pattern = '/<a\s+(?:[^>]*?\s+)?href="(?:https?:\/\/(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)|\/watch\?v=)[^"]*"[^>]*>(.*?)<\/a>/i';
          
              $sanitized_content = preg_replace_callback($pattern, function($match) {
                
                  return $match[0];
              }, $content);
              $sanitized_content = strip_tags($sanitized_content, '<a>');
              $sanitized_content = htmlspecialchars_decode($sanitized_content);
          
              return $sanitized_content;
          }
          $Games = sanitizeGames($Games);
        ?>

        <p class='games-section'>
          <?php echo $Games?>
        </p>

        <div class="circle-time" id='section3'>
          <img src="../icons/blue-book.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Books</p>
        </div>

        <!--  -->
       
        <div class='book-link-container'>
          <div class='flex'>
            

            <?php 
            $allowed_iframe_pattern = '/<iframe[^>]*src=["\']https?:\/\/(www\.youtube\.com\/embed\/|www\.youtube-nocookie\.com\/embed\/|www\.youtube\.com\/watch\?v=)[^"\']*["\'][^>]*><\/iframe>/i';

            if (preg_match($allowed_iframe_pattern, $Books)) {
              // Safe to render the iframe content
              echo $Books;
          } else {
              // Handle invalid or potentially unsafe content
              echo 'Invalid video link.';  
          }?>

          </div>
        </div>


        <!--  -->

        <div class="circle-time" style='margin-top: 20px;' id='section4'>
          <img src="../icons/music.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Songs</p>
        </div>
        
        <div class='book-link-container'>
          <div class='flex'>
            

            <?php 
            $allowed_iframe_pattern = '/<iframe[^>]*src=["\']https?:\/\/(www\.youtube\.com\/embed\/|www\.youtube-nocookie\.com\/embed\/|www\.youtube\.com\/watch\?v=)[^"\']*["\'][^>]*><\/iframe>/i';

            if (preg_match($allowed_iframe_pattern, $Songs)) {
              // Safe to render the iframe content
              echo $Songs;
          } else {
              // Handle invalid or potentially unsafe content
              echo 'Invalid video link.';  
          }?>

          </div>
        </div>
        
        <div class="circle-time" style='margin-top: 20px;' id='section5'>
          <img src="../icons/science2.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Experiments</p>
        </div>

        <div class='book-link-container' >
          <p class='games-section experiments_text'> 
            <?php echo htmlspecialchars($Experiments)?>
          </p>
        </div>

        <div class="circle-time" style='margin-top: 20px;'id='section6'>
          <img src="../icons/projects.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Projects</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section project_text'>
            

            <?php echo htmlspecialchars($Projects)?>
            
          </p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section7'>
          <img src="../icons/art.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Arts & Crafts</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section'>
            <?php echo htmlspecialchars($Arts_and_crafts)?>
          </p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section8'>
          <img src="../icons/trips.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Trips</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section school_trips_text'>
            <?php echo htmlspecialchars($School_trips)?>
          </p>
        </div>

        <div class="circle-time" style='margin-top: 20px;' id='section9'>
          <img src="../icons/otherideas.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Other Ideas</p>
        </div>

        <div class='book-link-container'>
          <p class='games-section otherIdeas'>
            <?php echo htmlspecialchars($Other_ideas)?>
          </p>
        </div>

        <div class="circle-time" style='margin-top: 20px;'id='section10'>
          <img src="../icons/worksheets.png" class="img-fluid plan-icon"> <p class='circle-time-text'>Worksheets</p>
        </div>

      </div>
    </div>



    <!-- WORKSHEETS -->
    <section class='worksheets' id="materials">

    <!-- make sure to use htmlspecialchars -->
   
      <!-- <div class="worksheet">
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
      </div> -->
      
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/plan.js"></script>
  </body>
</html>

