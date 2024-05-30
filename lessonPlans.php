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
    <div id="paginationContainer"></div>
    <button id="nextButton" onclick="loadMoreData('next')">Next</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>


// making the pagnation


var currentPage = 1;
var lessonsPerPage = 8;
var totalLessons = 0;
var totalPages = 0;

function fetchTotalLessons() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetchLessonPlans.php?getTotal=true', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            totalLessons = parseInt(xhr.responseText);
            totalPages = Math.ceil(totalLessons / lessonsPerPage);
            generatePaginationButtons();
        }
    };
    xhr.send();
}


function loadMoreData(direction, page = null) {
    if (page !== null) {
        currentPage = page;
    } else if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (direction === 'next' && currentPage < totalPages) {
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

            document.getElementById('prevButton').disabled = (currentPage === 1);
            document.getElementById('nextButton').disabled = (currentPage === totalPages);

            updateActivePageButton();
        }
    };
    xhr.send();
}


function generatePaginationButtons() {
    var paginationContainer = document.getElementById('paginationContainer');
    paginationContainer.innerHTML = '';

    for (var i = 1; i <= totalPages; i++) {
        var button = document.createElement('button');
        button.innerText = i;
        button.onclick = (function(page) {
            return function() {
                loadMoreData(null, page);
            };
        })(i);
        paginationContainer.appendChild(button);
    }

    document.getElementById('prevButton').disabled = (currentPage === 1);
    document.getElementById('nextButton').disabled = (currentPage === totalPages);

    updateActivePageButton();
}

function updateActivePageButton() {
    var buttons = document.getElementById('paginationContainer').getElementsByTagName('button');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = (i + 1 === currentPage);
        buttons[i].style.disabled = 'color: red;'
    }
}


fetchTotalLessons();
loadMoreData('next');


</script>

</body>
</html>




