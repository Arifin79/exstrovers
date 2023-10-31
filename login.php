<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="style/style_login.css" />
  </head>
  <body>
    <div class="login">
      <div class="frame">
        <div class="text-wrapper">Sign in</div>
        <div class="overlap-group"><div class="div">Username</div></div>
        <div class="overlap"><div class="div">Password</div></div>
        <div id="loginDiv" class="div-wrapper"><div class="text-wrapper-2">Login</div></div>
      </div>
      <div class="group">
        <div class="text-wrapper-3">WELCOME!</div>
        <img class="line" src="img/line-1.svg" />
        <p class="p">Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem</p>
      </div>
    </div>
  </body>
</html>

<script>
  document.getElementById("loginDiv").addEventListener("click", function() {
    window.location.href = "index.php";
  });
</script>
