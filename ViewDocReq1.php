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
    .navbar {
      overflow: hidden;
      background-color: #333;
    }
    .navbar a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Request</title>  
  <script>
    function goToUserProfileEmployed() {
      window.location.href = "http://localhost:3000/Software%20Design/ViewDocReq1.php";
    }

    function goToUserProfileNewlyEmployed() {
      window.location.href = "http://localhost:3000/Software%20Design/ViewDocReq1.php"; // Replace with the desired URL
    }

    function goToDocumentRequestEmployed() {
      window.location.href = "http://localhost:3000/Software%20Design/ViewDocReq.php";
    }

    function goToDocumentRequestNewlyEmployed() {
      window.location.href = "http://localhost:3000/Software%20Design/ViewDocReq.php"; // Replace with the desired URL
    }

    function logout() {
      window.location.href = "http://localhost:3000/Software%20Design/Logout.php";
    }
  </script>
</head>
<body>
  <div class="navbar">
    <a href="#" onclick="goToUserProfileEmployed()">User Profile (Employed)</a>
    <a href="#" onclick="goToUserProfileNewlyEmployed()">User Profile (Newly Employed)</a>
    <a href="#" onclick="goToDocumentRequestEmployed()">Document Requests (Employed)</a>
    <a href="#" onclick="goToDocumentRequestNewlyEmployed()">Document Requests (Newly Employed)</a>
    <a href="#" onclick="logout()">Logout</a>
  </div>

  <div class="content">
    <div class="frame" style="overflow-x: hidden;">
      <div class="div">
        <div class="overlap">
          <img class="group" src="img/group-4.png" />
          <div class="overlap-group"></div>
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
  </div>
</body>
<script>
  function navigateToNewlyEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/ViewNewEmployedProf.php"; // Replace with the desired URL
  }

  function navigateToEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/ViewEmployedProf.php"; // Replace with the desired URL
  }
</script>
</html>
';
?>
