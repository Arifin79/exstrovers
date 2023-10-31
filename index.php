<?php
 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar Dashboard Template</title>
    <link rel="stylesheet" href="style/style_index.css">
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
        <img src="img/pp.jpeg" class="profile_image" alt="">
        <h4>Arifin</h4>
      </div>
      <a href="index.php?page=tugas"><i class="fa fa-home" style="color: #0066FF;"></i><span>Dashboard</span></a>
      <a href="index.php?page=information"><i class="fa fa-envelope" style="color: #0066FF;"></i><span>Information</span></a>
      <a href="index.php?page=tim"><i class="fa fa-users" style="color: #0066FF;"></i><span>Teams</span></a>
      <a href="index.php?page=profile"><i class="fa fa-user" style="color: #0066FF;"></i><span style="margin-left: 8px;">Profile</span></a>
      <a href="login.php" style="margin-top: 125%;"><i class="fa fa-arrow-left" style="color: #FF0000;"></i><span style="color: #FF0000;">Logout</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
        <?php
            switch ($_GET['page']) {
            case 'profile':
                include "page/profile.php";
                break;
            case 'tugas':
                include "page/tugas.php";
                break;
            case 'information':
                include "page/information.php";
                break;
            case 'tim':
                include "page/tim.php";
                break;
            default:
                include "page/tugas.php";
                break;
            }
        ?>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

  </body>
</html>
      