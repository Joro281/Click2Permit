<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Employed2.css" />
  <style>
    .vector-wrapper {
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
  <title>Documentation Request (Employed) pg.2</title>
</head>
<body>
  <div class="navbar">
    <a href="#" onclick="goToUserProfileEmployed()">User Profile (Employed)</a>
    <a href="#" onclick="goToUserProfileNewlyEmployed()">User Profile (Newly Employed)</a>
    <a href="#" onclick="goToDocumentRequestsEmployed()">Document Requests (Employed)</a>
    <a href="#" onclick="goToDocumentRequestsNewlyEmployed()">Document Requests (Newly Employed)</a>
    <a href="#" onclick="goToEmail()">Send Email</a>
    <a href="#" onclick="logout()">Logout</a>
  </div>

  <div class="frame">
    <div class="div">
      <div class="overlap">
        <img class="group" src="img/group-4.png" />
        <div class="overlap-group"></div>
      </div>
    </div>
    <div class="overlap-2">
      <p class="p">View Requested Documents</p>
      <div class="group-2">
        <div class="vector-wrapper" onclick="navigateToCertificate4()"><img class="vector" src="img/Star.svg" /></div>
        <div class="text-wrapper-3" onclick="navigateToCertificate4()">CERTIFICATE OF EMPLOYMENT</div>
      </div>
    </div>
  </div>

  <script>
  function goToUserProfileEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/ViewEmployedProf.php";
}

function goToUserProfileNewlyEmployed() {
    window.location.href = "http://localhost:3000/Downloads/Software%20Design/ViewNewEmployedProf.php"; // Replace with the desired URL
}

function goToDocumentRequestEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/adminemployed1.php";
}

function goToDocumentRequestNewlyEmployed() {
    window.location.href = "http://localhost:3000/Software%20Design/adminemployed2.php"; // Replace with the desired URL
}
function goToEmail() {
    window.location.href = "http://localhost:3000/vendor/form.php"; // Replace with the desired URL
}

function logout() {
    window.location.href = "http://localhost:3000/Software%20Design/Logout.php";
}

    function navigateToCertificate4() {
      window.location.href = "http://localhost:3000/ViewCOE2.php"; // Replace with the desired URL
    }
  </script>
</body>
</html>
';
?>
