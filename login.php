<?php

@include 'assets/config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:index.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="style/style_login.css?v2" />
  </head>
  <body>
    <div class="login">
      <div class="frame">
      <form action="" method="post">
          <div class="text-wrapper">Sign in</div>
          <?php
            if(isset($error)){
              foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
              };
            };
          ?>
          <div class="overlap-group"> 
            <input type="email" name="email" class="div" autofocus="true" required placeholder="Email">
          </div>
          <div class="overlap">
            <input type="password" name="password" class="div" placeholder="Password" required>
          </div>
          <div class="div-wrapper">
            <button type="submit" name="submit" value="login now" class="text-wrapper-2">Login</button>
          </div>
      </form>
      </div>
      <div class="group">
        <div class="text-wrapper-3">WELCOME!</div>
        <img class="line" src="img/line-1.svg" />
        <p class="p">To Our Company</p>
      </div>
    </div>
  </body>
</html>