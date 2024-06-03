
<link rel="stylesheet" href="/styles/sidebar.css">
    
    <div class="sidebar">
      <div class="holder"> 
        <div style="display: flex; justify-content: center; align-items: center;">       
          <img src="/icons/filter.png" class="filter-icon">
          <h4>Filter by</h4>
        </div>
        <div class="line"></div>

        <form id="searchForm" action="your_search_endpoint.php" method="GET">
          <div class="holder-for-input">
              <input type="text" class="search-lesson" name="search" placeholder="Search by topic...">
              <img src="/icons/search.png" class="search-icon" id="searchButton">
          </div>
      </form>
        <!--  -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Game Type
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
               <ul>
                <li>
                  <label for="li" name='li'>Movement</label>
                  <input type="checkbox" name='li' id='li' class='checkbox'>
                </li>
                <li>
                  <label for="li-2" name='li'>Flashcards</label>
                  <input type="checkbox" name='li' id='li-2' class='checkbox'>
                </li>
                <li>
                  <label for="grade1" name='li'>Sports and Outdoor</label>
                  <input type="checkbox" name='li' id='grade1' class='checkbox'>
                </li>
                <li>
                  <label for="grade2" name='li'>Learning Apps</label>
                  <input type="checkbox" name='li' id='grade2' class='checkbox'>
                </li>
                <li>
                  <label for="grade3" name='li'>Computer Games</label>
                  <input type="checkbox" name='li' id='grade3' class='checkbox'>
                </li>
                <li>
                  <label for="grade4" name='li'>STEM</label>
                  <input type="checkbox" name='li' id='grade4' class='checkbox'>
                </li>
                <li>
                  <label for="grade5" name='li'>Team Building</label>
                  <input type="checkbox" name='li' id='grade5' class='checkbox'>
                </li>
                <li>
                  <label for="grade6" name='li'>Music and Instruments</label>
                  <input type="checkbox" name='li' id='grade6' class='checkbox'>
                </li>
                <li>
                  <label for="grade7" name='li'>Social and Cooperative</label>
                  <input type="checkbox" name='li' id='grade7' class='checkbox'>
                </li>
                <li>
                  <label for="grade8" name='li'>Role-playing</label>
                  <input type="checkbox" name='li' id='grade8' class='checkbox'>
                </li>
                <li>
                  <label for="grade9" name='li'>Cognitive and Memory</label>
                  <input type="checkbox" name='li' id='grade9' class='checkbox'>
                </li>
                <li>
                  <label for="grade10" name='li'>Language and Literacy</label>
                  <input type="checkbox" name='li' id='grade10' class='checkbox'>
                </li>
                <li>
                  <label for="grade11" name='li'>Reading</label>
                  <input type="checkbox" name='li' id='grade11' class='checkbox'>
                </li>
                <li>
                  <label for="grade12" name='li'>Dance and Rhythm</label>
                  <input type="checkbox" name='li' id='grade12' class='checkbox'>
                </li>
                <li>
                  <label for="adults" name='li'>Silent Games</label>
                  <input type="checkbox" name='li' id='adults' class='checkbox'>
                </li>
                
               </ul>
              </div>
            </div>
          </div>
        
         
         

        </div>
      </div>
    </div>
