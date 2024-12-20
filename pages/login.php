<?php
session_start(); // Start the session to store user info

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: /user/main.php"); // Redirect to the main page if logged in
    exit;
}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TeachersTactics/Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

     
    <h1>Login</h1>
    
    <form action="../includes/login-handler.php" method="post">
      
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" class="input_style">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" class="input_style">
      </div>
      
      <div class="form-group">
        <input type="submit" name="submit" placeholder="Repeat Password" value="Login" class="create-account-btn">
      </div>
    </form>
    
    <a href="registration.php" style="text-align: center; margin-top: 10px;">Don't have an account? Sign up here</a>
    <!-- <div class="google-sign-in-container">
      <button class="google-btn">
        <img src="../icons/google.png" class="google-img">
        Log in with Google
      </button>
    </div> -->
   </div>
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>