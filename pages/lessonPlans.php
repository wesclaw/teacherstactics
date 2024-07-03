<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>lesson Plans</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/lesson.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/lessonPlan.css">
  </head>
  <body>

  <?php include("../bars/navbar.php") ?>
  
 <div class="container lesson-wrapper">
    <?php /* include("includes/sidebar.html") */ ?>
    <div class="lesson-plan" id="lessonPlanContainer">
        <?php include '../includes/fetchLessonPlans.php';?>
    </div>  
</div>

  <div class="container lesson-btns">
    <button id="prevButton" onclick="loadMoreData('prev')">Back</button>
    <div id="paginationContainer"></div>
    <button id="nextButton" onclick="loadMoreData('next')">Next</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    applyLoadingEffects(); 
});

function applyLoadingEffects() {
    const plans = document.querySelectorAll('.plan');
    const img_el = document.querySelectorAll('.coverImage');

    plans.forEach(plan => {
        plan.classList.add('linkLoad');
    });

    img_el.forEach(img => {
        img.classList.add('worksheetLoad');
        img.addEventListener('load', function() {
            const parent = img.closest('.plan');
            parent.classList.remove('linkLoad');
            img.classList.remove('worksheetLoad');
            removeTextLoadingSkeletons(parent);
        });
    });

    applyTextLoadingEffects();
}

function applyTextLoadingEffects() {
    const title_el = document.querySelectorAll('.title');
    const age_el = document.querySelectorAll('.level');
    const description_el = document.querySelectorAll('.description');
    const btn_show = document.querySelectorAll('.plan-btn');
    const iconParent = document.querySelectorAll('.icon-parent')

    title_el.forEach(title => {
        title.classList.add('textLoad');
    });

    age_el.forEach(age => {
        age.classList.add('textLoad');
    });

    description_el.forEach(description => {
        description.classList.add('textLoad');
    });

    btn_show.forEach(btn => {
        btn.classList.add('textLoad');
    });
    
    iconParent.forEach((iParent)=>{
        iParent.classList.add('iconLoad')
    })

}

function removeTextLoadingSkeletons(parent) {
    const textElements = parent.querySelectorAll('.title, .level, .description, .plan-btn, .plan-lock');
    textElements.forEach(element => {
        element.classList.remove('textLoad');
        element.classList.remove('hide-icon');
        if(element.parentNode.classList.contains('iconLoad')){
            element.parentNode.classList.remove('iconLoad')
        }
    });
}

var currentPage = 1;
var lessonsPerPage = 8;
var totalLessons = 0;
var totalPages = 0;

function fetchTotalLessons() {
    var xhr = new XMLHttpRequest();
    var params = 'getTotal=' + encodeURIComponent('true');
    xhr.open('GET', '../includes/fetchLessonPlans.php?' + params, true);
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
    var params = 'offset=' + encodeURIComponent(offset) + '&limit=' + encodeURIComponent(lessonsPerPage);
    var url = '../includes/fetchLessonPlans.php?' + params;

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

            applyLoadingEffects();
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




