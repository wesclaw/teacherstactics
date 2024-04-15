<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>lesson Plans</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="icons/lesson.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/lessonPlan.css">
  </head>
  <body>

  <?php include("includes/navbar.html") ?>
  
 <div class="container lesson-wrapper">
    <?php include("includes/sidebar.html")?>
    <div class="lesson-plan" id="lessonPlanContainer">
        <?php include 'fetchLessonPlans.php';?>
    </div>   
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

  window.addEventListener('scroll', function() {
      if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
          loadMoreData();
      }
  });

  function loadMoreData() {
    var offset = document.querySelectorAll('.lesson-link').length;
    
    var url = 'fetchLessonPlans.php?offset=' + offset;

    var xhr = new XMLHttpRequest();

    xhr.open('GET', url, true); // Use the url variable here
    xhr.onload = function() {
        if (xhr.status === 200) {
            var newLessonPlansHTML = xhr.responseText;
            if (newLessonPlansHTML.trim() !== '') { // Check if response is not empty
                var lessonPlanContainer = document.getElementById('lessonPlanContainer');
                lessonPlanContainer.insertAdjacentHTML('beforeend', newLessonPlansHTML);
            }
        } else {
            console.error('Error loading more data:', xhr.statusText);
        }
    };
    xhr.send();
}

</script>

</body>
</html>
