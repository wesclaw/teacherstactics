<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Experiments</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/science.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/experiments.css">
  </head>
  <body>
  <?php include("../bars//navbar.php") ?>
  
  <div class="lesson-wrapper">

    <?php include("../bars/experiment_sidebar.php") ?>

    <div class="sport-name">
    <img src="../icons/science2.png" class="game-icon">
    <h1 style="font-weight: bold; text-transform: uppercase; margin: 0px; text-decoration: underline;">Experiments</h1>
    </div>
    
    <div class="lesson-plan games-plan" id="lessonPlanContainer">  
    <?php include("../includes/fetchPreschoolExperiments.php") ?>
    </div>    
  </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
    
    const lessonPlanContainer = document.getElementById('lessonPlanContainer')

    lessonPlanContainer.addEventListener('click', e => {
        const targetClass = e.target.className
        if(targetClass==='star-icon' || targetClass==='btn') {
          alert('Please create an account in order to favorite games');
        }
    });

    ///setting an event to the experiment container to get the seemore btn to appear

    // I will need to remove this effect on mobile and just add the more btn under at the bottom . no hover on mobile

    document.addEventListener('DOMContentLoaded', () => {
  const lessonPlanContainer = document.getElementById('lessonPlanContainer');

  lessonPlanContainer.addEventListener('mouseover', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.add('addtext');
      }
    }
  });

  lessonPlanContainer.addEventListener('mouseout', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.remove('addtext');
      }
    }
  });

  lessonPlanContainer.addEventListener('click', (e) => {
    if (e.target.matches('.seemorebtn')) {
      const btn = e.target;
      const gameElement = btn.closest('.game');
      if (gameElement) {
        const btn = gameElement.querySelector('.seemorebtn');
        gameElement.style.overflow = 'auto';
        btn.style.display = 'none'
        gameElement.classList.add('hide-overlay');
      }
    }
  });
});
  

    // 

    function checkForVideo(){
    const video_link = document.querySelector('.video-link')
    if(video_link.innerHTML===''){
      video_link.remove()
    }
    }
    checkForVideo()

    const lessonContainer = document.querySelector('.btn');

    lessonContainer.addEventListener('mouseover', () => {
      lessonContainer.querySelector('.hover-message').style.display = 'block';
    });

    lessonContainer.addEventListener('mouseout', () => {
      lessonContainer.querySelector('.hover-message').style.display = 'none';
    });

    const text_des =document.querySelectorAll('.text-des')

      text_des.forEach(des => {
        const textContent = des.innerHTML;
        const regex = /([^.!?:]*?:)/g;
        let modifiedContent = textContent.replace(regex, '<br><b>$1</b><br>');
        if (modifiedContent.startsWith('<br>')) {
          modifiedContent = modifiedContent.slice(4); 
        }
        des.innerHTML = modifiedContent;
      });

      

      
   
    </script>
  </body>
</html>