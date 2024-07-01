
<link rel="stylesheet" href="/styles/sidebar.css">
    
    <div class="sidebar">
      <div class="holder"> 
        <div style="display: flex; justify-content: center; align-items: center;">       
          <img src="../icons/filter.png" class="filter-icon">
          <h4>Filter by</h4>
        </div>
        <div class="line"></div>

        <form id="searchForm" action="your_search_endpoint.php" method="GET">
          <div class="holder-for-input">
              <input type="text" class="search-lesson" name="search" placeholder="Search...">
              <img src="../icons/search.png" class="search-icon" id="searchButton">
          </div>
      </form>
        <!--  -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Tracing
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show">
              <div class="accordion-body">
               <ul>
                <li>
                  <label for="li" name='li'>Letters</label>
                  <input type="checkbox" name='li' id='li' class='checkbox'>
                </li>
                <li>
                  <label for="li-2" name='li'>Numbers</label>
                  <input type="checkbox" name='li' id='li-2' class='checkbox'>
                </li>
                <li>
                  <label for="grade1" name='li'>Shapes</label>
                  <input type="checkbox" name='li' id='grade1' class='checkbox'>
                </li>
                <li>
                  <label for="grade2" name='li'>Lines and Patterns</label>
                  <input type="checkbox" name='li' id='grade2' class='checkbox'>
                </li>   
               </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Counting and Numbers
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show">
              <div class="accordion-body">
              <li>
                  <label for="math" name='li'>Number Recognition</label>
                  <input type="checkbox" name='li' id='math' class='checkbox'>
                </li>
              <li>
                  <label for="reading" name='li'>Counting Objects</label>
                  <input type="checkbox" name='li' id='reading' class='checkbox'>
                </li>
              <li>
                  <label for="social-studies" name='li'>Number Matching</label>
                  <input type="checkbox" name='li' id='social-studies' class='checkbox'>
                </li>
              <li>
                  <label for="science" name='li'>Addition and Subtraction</label>
                  <input type="checkbox" name='li' id='science' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Alphabet and Phonics
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show">
              <div class="accordion-body">
              <li>
                  <label for="a1" name='li'>Letter Recognition</label>
                  <input type="checkbox" name='li' id='a1' class='checkbox'>
                </li>
              <li>
                  <label for="a2" name='li'>Beginning Sounds</label>
                  <input type="checkbox" name='li' id='a2' class='checkbox'>
                </li>
              <li>
                  <label for="b1" name='li'>Uppercase and Lowercase Matching</label>
                  <input type="checkbox" name='li' id='b1' class='checkbox'>
                </li>
             
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Fine Motor Skills
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse show">
              <div class="accordion-body">
              <li>
                  <label for="com_club" name='li'>Cutting Practice</label>
                  <input type="checkbox" name='li' id='com_club' class='checkbox'>
                </li>
              <li>
                  <label for="guitar" name='li'>Dot-to-Dot</label>
                  <input type="checkbox" name='li' id='guitar' class='checkbox'>
                </li>
              <li>
                  <label for="piano" name='li'>Puzzles</label>
                  <input type="checkbox" name='li' id='piano' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>


          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Handwriting Practice
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Writing" name='li'>Name Writing</label>
                  <input type="checkbox" name='li' id='Writing' class='checkbox'>
                </li>
              <li>
                  <label for="Letter" name='li'>Letter Formation</label>
                  <input type="checkbox" name='li' id='Letter' class='checkbox'>
                </li>
              <li>
                  <label for="Words" name='li'>Writing Simple Words</label>
                  <input type="checkbox" name='li' id='Words' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>




          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              Math Concepts
              </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Comparing" name='li'>Comparing Sizes (big/small)</label>
                  <input type="checkbox" name='li' id='Comparing' class='checkbox'>
                </li>
              <li>
                  <label for="Measuring" name='li'>Measuring Lengths</label>
                  <input type="checkbox" name='li' id='Measuring' class='checkbox'>
                </li>
              <li>
                  <label for="Shapes" name='li'>Identifying Shapes</label>
                  <input type="checkbox" name='li' id='Shapes' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>


          
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              Social Studies and Science
              </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Community" name='li'>Community Helpers</label>
                  <input type="checkbox" name='li' id='Community' class='checkbox'>
                </li>
              <li>
                  <label for="Weather" name='li'>Seasons and Weather</label>
                  <input type="checkbox" name='li' id='Weather' class='checkbox'>
                </li>
              <li>
                  <label for="Habitats" name='li'>Animals and Habitats</label>
                  <input type="checkbox" name='li' id='Habitats' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>



          
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
              Creative Arts
              </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Coloring" name='li'>Coloring Pages</label>
                  <input type="checkbox" name='li' id='Coloring' class='checkbox'>
                </li>
              <li>
                  <label for="Drawing" name='li'>Drawing Prompts</label>
                  <input type="checkbox" name='li' id='Drawing' class='checkbox'>
                </li>
              <li>
                  <label for="Simple" name='li'>Simple Crafts</label>
                  <input type="checkbox" name='li' id='Simple' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>



          
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
              Emotional Learning
              </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Identifying" name='li'>Identifying Emotions</label>
                  <input type="checkbox" name='li' id='Identifying' class='checkbox'>
                </li>
              <li>
                  <label for="Turns" name='li'>Sharing and Taking Turns</label>
                  <input type="checkbox" name='li' id='Turns' class='checkbox'>
                </li>
              <li>
                  <label for="Friends" name='li'>Family and Friends</label>
                  <input type="checkbox" name='li' id='Friends' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>


          
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
              Patterns and Sequences
              </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse">
              <div class="accordion-body">
              <li>
                  <label for="Pattern" name='li'>Pattern Recognition</label>
                  <input type="checkbox" name='li' id='Pattern' class='checkbox'>
                </li>
              <li>
                  <label for="Completing" name='li'>Completing Patterns</label>
                  <input type="checkbox" name='li' id='Completing' class='checkbox'>
                </li>
              <li>
                  <label for="Sequencing" name='li'>Sequencing Events</label>
                  <input type="checkbox" name='li' id='Sequencing' class='checkbox'>
                </li>
              <li>
                  <label for="Objects" name='li'>Sorting Objects</label>
                  <input type="checkbox" name='li' id='Objects' class='checkbox'>
                </li>
              <li>
                  <label for="cards" name='li'>Matching cards</label>
                  <input type="checkbox" name='li' id='cards' class='checkbox'>
                </li>
              <li>
                  <label for="Memory" name='li'>Memory</label>
                  <input type="checkbox" name='li' id='Memory' class='checkbox'>
                </li>
              
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
