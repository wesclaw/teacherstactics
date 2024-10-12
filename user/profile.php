<?php
session_start();

// Check if the user is signed up (by verifying if the session is active)
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/registration.php");
    exit;
}

?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/logo-pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/userHome.css">
  </head>
  <body>

  <?php include('../bars/navbar.php')?>;



  <div class="container main">
        <p class="account-top-tag">My account</p>

        <div class="user">
          <!-- ////make this a form  -->
            <div class="image-edit">
              <img src="../icons/user2.png" class="image-edit">
              <button>Change</button>
            </div>
            <div class="wrapper-for-both-input-blocks">
            <div class="wrap personal-data">
             <h6>Personal Data</h6> 
             <!--  -->
             <form action="" method="POST" class="wrap">
               <input type="text" placeholder="Your name" value="<?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?>">
              <input type="Your email" placeholder="Your email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>">
              <button>Save Changes</button>
             </form>
             </div>

             <div class="wrap password-change">
             <h6>Password Change</h6> 
             <form action="" method="POST" class="wrap">
             <input type="password" placeholder="Current password">
              <input type="password" placeholder="New password">
              <input type="password" placeholder="Confirm new password">
              <div style="display: flex; justify-content: space-between;">
              <button class="submitBtn">Save Changes</button>
              <button class="deleteAccountBtn">Delete account</button>
              </div>
              
              
             </form>
             
             </div>
            </div>
            

        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="" async defer></script>
  </body>
</html>