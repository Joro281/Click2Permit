<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Docreq.css" />
  <style>
    .admin-button, .overlap-wrapper {
      cursor: pointer;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Request</title>  
  <script>
  function goToUserProfile() {
    window.location.href = "http://localhost:3000/UserProf.php";
  }

  function goToDocumentRequest() {
    window.location.href = "http://localhost:3000/DocReq.php";
  }

  function logout() {
    window.location.href = "http://localhost:3000/Logout.php";
  }
  </script>
</head>
<body>
  <div class="frame" style="overflow-x: hidden;">
    <div class="div">
    <div class="overlap">
    <div class="dropdown">
    <button class="dropbtn">Menu</button>
    <div class="dropdown-content">
      <a href="#" onclick="goToUserProfile()">User Profile</a>
      <a href="#" onclick="goToDocumentRequest()">Document Request</a>
      <a href="#" onclick="logout()">Logout</a>
    </div>
  </div>
    <img class="group" src="img/group-4.png" />
    <div class="overlap-group">
    </div>
    </div>
    </div>
    <div class="overlap-2">
    <div class="overlap-3">
    <div class="text-wrapper-3">Employed or Newly Employed?</div>
    <img class="rectangle" src="img/rectangle-4.png" />
    </div>
    <div class="admin-button" onclick="navigateToNewlyEmployed()">
    <div class="overlap-group-2">
    <div class="rectangle-2"></div>
    <div class="text-wrapper-4">New Employed</div>
    </div>
    </div>
    <div class="overlap-wrapper" onclick="navigateToEmployed()">
    <div class="overlap-group-2">
    <div class="rectangle-2"></div>
    <div class="text-wrapper-4">Employed</div>
    </div>
    </div>
    </div>
    </div>
</body>
<script>
  function navigateToNewlyEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/NewEmployed.php"; // Replace with the desired URL
  }

  function navigateToEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/ViewDocEmployed.php"; // Replace with the desired URL
  }
</script>
</html>
';
?>
