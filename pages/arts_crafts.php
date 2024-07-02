<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Arts & Crafts</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/paint.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/games.css">
  </head>
  <body>
  
  <?php include("../bars//navbar.php") ?>
  
  <div class="lesson-wrapper">

  <?php include("../bars/artsCrafts_sidebar.php") ?>

    <div class="sport-name">
    <img src="../icons/art.png" class="game-icon">
    <h1 style="font-weight: bold; text-transform: uppercase; margin: 0px; text-decoration: underline;">Arts & Crafts</h1>
    </div>
    
    <div class="lesson-plan games-plan" id="lessonPlanContainer">  
    <?php include("../includes/fetchPreschoolArts.php") ?>
    </div>    
  </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

    const lessonPlanContainer = document.getElementById('lessonPlanContainer')

    lessonPlanContainer.addEventListener('click', e => {
        const target = e.target.tagName;
        if (target === 'IMG' || target === 'BUTTON') {
            alert('Please create an account in order to favorite arts and crafts');
        }
    });
      
      
      const lessonContainer = document.querySelector('.btn');

      lessonContainer.addEventListener('mouseover', () => {
          lessonContainer.querySelector('.hover-message').style.display = 'block';
      });

      lessonContainer.addEventListener('mouseout', () => {
          lessonContainer.querySelector('.hover-message').style.display = 'none';
      });

     
    </script>
  </body>
</html>