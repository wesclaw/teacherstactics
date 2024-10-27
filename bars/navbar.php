 <?php require_once('../includes/getProfileImage.php'); ?>

    <link rel="stylesheet" href="../styles/navbar.css">
  
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container fluid">
      
      <a href="<?php 
        // Check if user is logged in
        if (isset($_SESSION['user_id'])) { 
            echo '../user/main.php'; // Redirect to user dashboard if logged in
        } else { 
            echo '../pages/index.php'; // Redirect to homepage if not logged in
        } 
        ?>">
        <img src="../icons/logo3.png" class="nav-logo">
      </a>
       
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">

          <li class="nav-item">
            <a class="" href="../pages/lessonPlans.php">
              <button class="btn btn-success" type="button">Lesson Plans</button>
              </a>
          </li>

         
            
          <li class="nav-item">
            <a class="" href="../pages/worksheets.php">
              <button class="btn btn-danger" type="button">Worksheets</button>
              </a>
          </li>
         
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              More
            </button>
            <ul class="dropdown-menu">
            
              <!-- <li class="nav-item dropdown-item">
                <img src="../icons/note.png" class="nav-icon">
                  <a class="nav-link dropdown-item" href="songs.php">Songs</a>
              </li>

              

              <li class="nav-item dropdown-item">
                <img src="../icons/book-icon.png" class="nav-icon">
                  <a class="nav-link dropdown-item" href="books.php">Books</a>
              </li> -->

              
                

                <a class="nav-link dropdown-item" aria-current="page" href="../pages/arts_crafts.php">
                <li class="nav-item dropdown-item">
                <img src="../icons/paint.png" class="nav-icon">
                 Arts & Crafts
                </li> 
                </a>

                <a class="nav-link dropdown-item" href="../pages/experiments.php">
                <li class="nav-item dropdown-item">
                <img src="../icons/science.png" class="nav-icon">
                Experiments
                </li></a>


                <a class="nav-link dropdown-item" href="../pages/games.php">
                <li class="nav-item dropdown-item">
                <img src="../icons/games.png" class="nav-icon">Games
                </li></a>

                
                    

            </ul>
          </div>

         
          <!-- <div class="dropdown">
          <button class="btn userBtn dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../icons/user.png" class="user-image">
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><button class="dropdown-item" type="button">Profile</button></li>
            <li><button class="dropdown-item" type="button">Settings</button></li>
            <li><button class="dropdown-item" type="button">Sign out</button></li>
          </ul>
        </div> -->



        <!--  -->

        
        <?php 
        // Check if user is signed in by checking session
        if (isset($_SESSION['user_id'])) { 
        ?>
          <!-- User is signed in, display the profile section -->
          <div class="dropdown">
            
            <button class="btn userBtn dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">


              <!-- <img src="../icons/user2.png" class="user-image" alt="User Image"> -->

              
              <img src="<?php echo htmlspecialchars($profileImageUrl); ?>" class='user-image'>   
              
              
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

            <li><a class="dropdown-item" type="button" href="../user/main.php">Home</a></li>

              <li><a class="dropdown-item" type="button" href="../user/profile.php">Account</a></li>
              
              
              <li><a class="dropdown-item" type="button" href="../user/savedMaterials.php">Saved Materials</a></li>
              <li><a class="dropdown-item" href="../includes/logout.php">Sign out</a></li>
            </ul>
          </div>
        <?php 
        } else { 
        ?>
          <!-- User is not signed in, display the Sign Up and Login options -->
          <li class="signInTab"><a href="../pages/registration.php" class="signATag">Sign Up Free</a></li>
          
        <?php 
        } 
        ?>
  
        <!--  -->
        
          
          

        </ul>
      </div>
    </div>
  </nav> 

