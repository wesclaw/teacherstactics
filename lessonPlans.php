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
    <?php /* include("includes/sidebar.html") */ ?>
    <div class="lesson-plan" id="lessonPlanContainer">
        <?php include 'fetchLessonPlans.php';?>
    </div>  
</div>

<div class="container lesson-btns">
    <button id="prevButton" onclick="loadMoreData('prev')">Back</button>
    <button id="nextButton" onclick="loadMoreData('next')">Next</button>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>


// making the pagnation


var currentPage = 0;
var lessonsPerPage = 8;

function loadMoreData(direction) {

    if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (direction === 'next') {
        currentPage++;
    }

    var offset = (currentPage - 1) * lessonsPerPage;
    var url = 'fetchLessonPlans.php?offset=' + offset + '&limit=' + lessonsPerPage;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            var newLessonPlansHTML = xhr.responseText;
            var lessonPlanContainer = document.getElementById('lessonPlanContainer');
            lessonPlanContainer.innerHTML = newLessonPlansHTML;

            // Enable or disable buttons based on currentPage and loaded data

            const prevButton =document.getElementById('prevButton')

            prevButton.disabled = currentPage===1
           
            if (newLessonPlansHTML.trim().split('</div>').length - 1 < lessonsPerPage) {
              const nextButton =document.getElementById('nextButton')
                nextButton.disabled = true
                nextButton.style.pointerEvents = 'auto';

            } else {
                document.getElementById('nextButton').disabled = false;
            }
        } 
    };
    xhr.send();
}





loadMoreData('next');



  















  //////////////////this was for the ajax only. on scrolll load more content.

//   window.addEventListener('scroll', function() {
//       if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
//           loadMoreData();
//       }
//   });

//   function loadMoreData() {
//     var offset = document.querySelectorAll('.lesson-link').length;
    
//     var url = 'fetchLessonPlans.php?offset=' + offset;

//     var xhr = new XMLHttpRequest();

//     xhr.open('GET', url, true); // Use the url variable here
//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             var newLessonPlansHTML = xhr.responseText;
//             if (newLessonPlansHTML.trim() !== '') { // Check if response is not empty
//                 var lessonPlanContainer = document.getElementById('lessonPlanContainer');
//                 lessonPlanContainer.insertAdjacentHTML('beforeend', newLessonPlansHTML);
//             }
//         } else {
//             console.error('Error loading more data:', xhr.statusText);
//         }
//     };
//     xhr.send();
// };


</script>

</body>
</html>




