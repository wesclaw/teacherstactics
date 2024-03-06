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

  <div class="container">
  <div class="sidebar">
    <div class="holder">
      <div style="display: flex; justify-content: center; align-items: center; margin-top: 110px;">
        <img src="icons/filter.png" class="filter-icon">
        <h4>Filter by</h4>
      </div>
      <div class="line"></div>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Ages
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
             <ul>
              <li>
                <label for="li" name='li'>Nursery (2-3 years old)</label>
                <input type="checkbox" name='li' id='li' class='checkbox'>
              </li>
              <li>
                <label for="li-2" name='li'>Preschool (3-6 years old)</label>
                <input type="checkbox" name='li' id='li-2' class='checkbox'>
              </li>
              <li>
                <label for="grade1" name='li'>Grade 1</label>
                <input type="checkbox" name='li' id='grade1' class='checkbox'>
              </li>
              <li>
                <label for="grade2" name='li'>Grade 2</label>
                <input type="checkbox" name='li' id='grade2' class='checkbox'>
              </li>
              <li>
                <label for="grade3" name='li'>Grade 3</label>
                <input type="checkbox" name='li' id='grade3' class='checkbox'>
              </li>
              <li>
                <label for="grade4" name='li'>Grade 4</label>
                <input type="checkbox" name='li' id='grade4' class='checkbox'>
              </li>
              <li>
                <label for="grade5" name='li'>Grade 5</label>
                <input type="checkbox" name='li' id='grade5' class='checkbox'>
              </li>
              <li>
                <label for="grade6" name='li'>Grade 6</label>
                <input type="checkbox" name='li' id='grade6' class='checkbox'>
              </li>
              <li>
                <label for="grade7" name='li'>Grade 7</label>
                <input type="checkbox" name='li' id='grade7' class='checkbox'>
              </li>
              <li>
                <label for="grade8" name='li'>Grade 8</label>
                <input type="checkbox" name='li' id='grade8' class='checkbox'>
              </li>
              <li>
                <label for="grade9" name='li'>Grade 9</label>
                <input type="checkbox" name='li' id='grade9' class='checkbox'>
              </li>
              <li>
                <label for="grade10" name='li'>Grade 10</label>
                <input type="checkbox" name='li' id='grade10' class='checkbox'>
              </li>
              <li>
                <label for="grade11" name='li'>Grade 11</label>
                <input type="checkbox" name='li' id='grade11' class='checkbox'>
              </li>
              <li>
                <label for="grade12" name='li'>Grade 12</label>
                <input type="checkbox" name='li' id='grade12' class='checkbox'>
              </li>
              <li>
                <label for="adults" name='li'>Adults</label>
                <input type="checkbox" name='li' id='adults' class='checkbox'>
              </li>
             </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Subject
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>