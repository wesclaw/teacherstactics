<?php 
  
  $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

  unset($_SESSION['error']); 
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/signup.css">
  </head>
  <body>
    </body>

    <?php include("../bars/navbar.php")?>

   <div class="container main-section">

   
     
    <h1>Sign Up</h1>
    
    <form action="../includes/form-handler.php" method="POST" novalidate>
      <div class="form-group">
        <input type="text" name="name" placeholder="Name" class="input_style" required="true">
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" class="input_style" required="true">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" class="input_style" required="true">
      </div>
      <div class="form-group">
        <input type="password" name="repeat_password" placeholder="Repeat Password" class="input_style"> 
      </div>
      <div class="form-group">
        <input type="submit" name="submit" placeholder="Repeat Password" value="Create Account" class="create-account-btn">
      </div>
      <!--  -->
      <?php if ($error): ?>
    <h6 class="error-message"><?php echo $error; ?></h6>
      <?php endif; ?>
      
      <!--  -->
    </form>
    <!--  -->
   
    <!--  -->
    <p style="margin-top: 20px; font-family: sans-serif;">By creating an account, you agree to our <a href="#">terms</a></p>
    <a href="login.php" style="text-align: center; margin-top: 10px;">Already have an account? Log in here</a>
    <div class="google-sign-in-container">
      <button class="google-btn">
        <img src="../icons/google.png" class="google-img">
        Sign up with Google
      </button>
    </div>
   </div>
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>