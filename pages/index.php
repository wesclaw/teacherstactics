<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TeachersTactics</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">
  </head> 
  <body>
    <?php include("../bars/navbar.php")?>
<main>
  <div class="container">
    <h1>Innovate Your English Classroom</h1>
    <p>We provide all the <strong>resources</strong> you need for your classroom and school. Let us do the planning <strong>while you focus on the teaching.</strong></p>

    <div style="display: flex; align-items: center; justify-content: center;"> 
    <!-- i added these classes to the div. before it was just an empty div but changed the btn to an a tag -->

    <a href="/pages/login.php">
        <button class="login-btn">
          <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <img src="../icons/login.png" class="btn-icon">
          <p>Log in</p>
          </div>
        </button>
      </a>

   
      <a href="/pages/registration.php" class="member-link">
        <button class="member-btn">
          <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <img src="../icons/plus.png" class="btn-icon">
          <p>Sign Up</p>
          </div>
        </button>
      </a>
   
    </div>
  </div>
  
</main>
<section class='taglines'>
  <div class="container">
  
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>