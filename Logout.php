<?php
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Logoutguide.css" />
  <link rel="stylesheet" href="css/Logout.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
  <script>
    // Disable the browser back button
    history.replaceState(null, null, location.href);

    // Check for back button navigation
    window.addEventListener("popstate", function (event) {
        history.pushState(null, null, location.href);
        window.location.replace("http://localhost:3000/LogoutGuide.php");
    });
  </script>
</head>
<body>
  <div class="frame">
    <div class="div">
    <div class="overlap">
    <img class="group" src="img/group-4.png" />
    <div class="overlap-group">
    </div>
    </div>
    </div>
    <div class="overlap-2">
    <p class="p">You have been successfully Logged out!</p>

    <a href="http://localhost:3000/UserLogin.php">
    <div class="user-button">
    <div class="overlap-3">
    <div class="rectangle"></div>
    <div class="text-wrapper-3">user</div>
    </a>
    </div>
    </div>
    <a href="http://localhost:3000/AdminLogin.php">
    <div class="admin-button">
    <div class="overlap-3">
    <div class="rectangle"></div>
    <div class="text-wrapper-3">admin</div>
    </a>
    </div>
    </div>
    <p class="text-wrapper-4">Enter the portal again as an</p>
    <div class="text-wrapper-5">or</div>
    <p class="supporting-text">
    <span class="span">Don&#39;t have an account yet?</span>
    <span class="text-wrapper-6">&nbsp;</span>
    <a href="http://localhost:3000/SignupDB.php"style="text-decoration: none;"> 
    <span class="text-wrapper-7">Sign up here</span>
    </p>
    </a>
    <img class="img" src="img/rectangle-4.png" />
    </div>
    </div>
    </div>
</body>
</html>
';
?>
