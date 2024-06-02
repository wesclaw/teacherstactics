<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Games</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/games.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/games.css">
  </head>
  <body>
  <?php include("../bars/navbar.php") ?>

  <div class="container lesson-wrapper">
    <?php include("../bars/games_sidebar.php") ?>

    <div class="lesson-plan games-plan" id="lessonPlanContainer">
      
      <!-- inlcudes game php here -->

      <div class="game">
        <div class="top-title">
          <h4 class="title">Tallest To Shortest</h4>
            <button>
               <img src="../icons/star.png" class="star-icon">
            </button>
      </div>
        <div class="line"></div>

        <!-- iframe for youtibe game link -->

        <!-- <div class="video-link">
          <iframe src=""></iframe>
        </div> -->


        <!--  -->
        <h5>Materials:</h5>
        <ul>
          <li>Music</li>
        </ul>
        <div class="line"></div>
        <h5>Game:</h5>
        <p>Play some music and let the students dance around the classroom. When the music pauses, challenge them to form a line from tallest to shortest, moving like a slithering snake. Then, switch it up and go from shortest to tallest. To add more fun, designate a student as the "captain" to organize everyone when the music stops, enhancing leadership skills in a playful setting.</p>
      </div>
      
      <div class="game">
        <div class="top-title">
          <h4 class="title">Tallest To Shortest</h4>
            <button>
               <img src="../icons/star.png" class="star-icon">
            </button>
      </div>
        <div class="line"></div>

        <!-- iframe for youtibe game link -->

        <!-- <div class="video-link">
          <iframe src=""></iframe>
        </div> -->


        <!--  -->
        <h5>Materials:</h5>
        <ul>
          <li>Music</li>
        </ul>
        <div class="line"></div>
        <h5>Game:</h5>
        <p>Play some music and let the students dance around the classroom. When the music pauses, challenge them to form a line from tallest to shortest, moving like a slithering snake. Then, switch it up and go from shortest to tallest. To add more fun, designate a student as the "captain" to organize everyone when the music stops, enhancing leadership skills in a playful setting.</p>
      </div>
      



    </div>    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script async defer>
      const lessonPlanContainer = document.getElementById('lessonPlanContainer')
      lessonPlanContainer.addEventListener('click',e=>{
        const target = e.target.tagName
        if(target==='IMG' || target==='BUTTON'){
          alert('Please create an account in order to favorite games')
        }
      })
      
    </script>
  </body>
</html>