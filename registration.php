<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/signup.css">
  </head>
  <body>
    </body>

    <?php include 'includes/navbar.html'?>

   <div class="container main-section">
    </div>

    <?php 
      if(isset($_POST)["submit"]){
        $firstName = $_POST["first_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeat_password"];
      };
      $error = array();
      if(empty($firstName)){

      };
    ?>

    
    <h1>Sign Up</h1>
    
    <form action="registration.php">
      <div class="form-group">
        <input type="text" name="first_name" placeholder="First Name" class="input_style">
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" class="input_style">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" class="input_style">
      </div>
      <div class="form-group">
        <input type="password" name="repeat_password" placeholder="Repeat Password" class="input_style">
      </div>
      <div class="form-group">
        <input type="submit" name="submit" placeholder="Repeat Password" value="Create Account" class="create-account-btn">
      </div>
    </form>
    <p style="margin-top: 20px; font-family: sans-serif;">By creating an account, you agree to our <a href="#">terms</a></p>
    <a href="login.php" style="text-align: center; margin-top: 10px;">Already have an account? Log in here</a>
   </div>
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>