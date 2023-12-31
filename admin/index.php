<?php
  @include '../assets/config.php';

  session_start();

  if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar Dashboard Template</title>
    <link rel="stylesheet" href="../style/style_index_admin.css?v2">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/js/ckeditor.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <div class="left_area">
        <h3><span>Extrovers</span></h3>
      </div>
    </header>
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="../assets/img/pp.jpeg" class="profile_image" alt="">
        <h4>Arifin</h4>
      </div>
      <a href="index.php?page=dashboard"><i class="fa fa-home" style="color: #0066FF;"></i><span>Dashboard</span></a>
      <a href="index.php?page=tugas"><i class="fa fa-bars" style="color: #0066FF;"></i><span>Tugas</span></a>
      <a href="index.php?page=register"><i class="fa fa-user-plus" style="color: #0066FF;"></i><span>Create Account</span></a>
      <a href="index.php?page=information"><i class="fa fa-envelope" style="color: #0066FF;"></i><span>Information</span></a>
      <a href="index.php?page=profile"><i class="fa fa-user" style="color: #0066FF;"></i><span style="margin-left: 8px;">Profile</span></a>
      <a href="logout.php" style="margin-top: 125%;"><i class="fa fa-arrow-left" style="color: #FF0000;"></i><span style="color: #FF0000;">Logout</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
        <?php
            switch ($_GET['page']) {
            case 'dashboard':
                include "page/dashboard.php";
                break;
            case 'profile':
                include "page/profile.php";
                break;
            case 'register':
                include "page/register.php";
                break;
            case 'information':
                include "page/information.php";
                break;
            default:
                include "page/dashboard.php";
                break;
            }
        ?>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>
  </body>
</html>