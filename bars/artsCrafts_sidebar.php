
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
              <input type="text" class="search-lesson" name="search" placeholder="Search...">
              <img src="/icons/search.png" class="search-icon" id="searchButton">
          </div>
      </form>
        <!--  -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Art & Craft Type
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
               <ul>
                <li>
                  <label for="li" name='li'>Painting</label>
                  <input type="checkbox" name='li' id='li' class='checkbox'>
                </li>
                <li>
                  <label for="li-2" name='li'>Drawing and Coloring</label>
                  <input type="checkbox" name='li' id='li-2' class='checkbox'>
                </li>
                <li>
                  <label for="grade1" name='li'>Paper Crafts</label>
                  <input type="checkbox" name='li' id='grade1' class='checkbox'>
                </li>
                <li>
                  <label for="grade2" name='li'>Collage Making</label>
                  <input type="checkbox" name='li' id='grade2' class='checkbox'>
                </li>
                <li>
                  <label for="grade3" name='li'>Clay and Dough</label>
                  <input type="checkbox" name='li' id='grade3' class='checkbox'>
                </li>
                <li>
                  <label for="grade4" name='li'>Textile and Fabric Crafts</label>
                  <input type="checkbox" name='li' id='grade4' class='checkbox'>
                </li>
                <li>
                  <label for="grade5" name='li'>Building and Constructing</label>
                  <input type="checkbox" name='li' id='grade5' class='checkbox'>
                </li>
                <li>
                  <label for="grade6" name='li'>Holiday and Seasonal</label>
                  <input type="checkbox" name='li' id='grade6' class='checkbox'>
                </li>
                <li>
                  <label for="grade7" name='li'>Nature</label>
                  <input type="checkbox" name='li' id='grade7' class='checkbox'>
                </li>
                <li>
                  <label for="grade8" name='li'>3D Art and Sculpture</label>
                  <input type="checkbox" name='li' id='grade8' class='checkbox'>
                </li>
                
                
               </ul>
              </div>
            </div>
          </div>
        
         
         

        </div>
      </div>
    </div>



