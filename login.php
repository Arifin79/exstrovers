<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="style/style_login.css?v2" />
  </head>
  <body>
    <div class="login">
      <div class="frame">
        <div class="text-wrapper">Sign in</div>
        <div class="overlap-group"> 
          <input type="text" name="username" id="username" class="div" autofocus="true" required placeholder="Username">
        </div>
        <div class="overlap">
          <input type="password" name="password" id="password" class="div" placeholder="Password" required>
        </div>
        <div id="loginDiv" class="div-wrapper">
        <button type="submit" class="text-wrapper-2">Login</button>
        </div>
        
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
