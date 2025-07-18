<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Adminemployed1.css" />
  <style>
    .vector-wrapper {
      cursor: pointer;
    }

    .admin-back {
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
  <title>Documentation Request (Employed) pg.1 </title>
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
        <div class="vector-wrapper" onclick="navigateToCertificate1()">
          <img class="vector" src="img/Star.svg" />
        </div>
        <p class="text-wrapper-3">CERTIFICATE OF EMPLOYMENT</p>
        <div class="group-3">
          <div class="vector-wrapper" onclick="navigateToCertificate2()"><img class="vector" src="img/Star.svg" /></div>
          <p class="text-wrapper-4" onclick="navigateToCertificate2()">CERTIFICATE OF SERVICE RECORD</p>
        </div>
      </div>
      <div class="group-4">
        <div class="vector-wrapper" onclick="navigateToCertificate3()"><img class="vector" src="img/Star.svg" /></div>
        <p class="text-wrapper-5">CERTIFICATE OF LEAVE CREDITS</p>
        <div class="group-5">
          <div class="vector-wrapper" onclick="navigateToCertificate5()"><img class="vector" src="img/Star.svg" /></div>
          <p class="flexcontainer">
            <span class="span" onclick="navigateToCertificate5()">CERTIFICATE OF AUTHORITY TO TRAVEL<br /></span>
          </p>
        </div>
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

    function navigateToCertificate1() {
      window.location.href = "http://localhost:3000/ViewCOE.php"; // Replace with the desired URL
    }

    function navigateToCertificate2() {
      window.location.href = "http://localhost:3000/ViewService.php"; // Replace with the desired URL
    }

    function navigateToCertificate3() {
      window.location.href = "http://localhost:3000/ViewLeave.php"; // Replace with the desired URL
    }

    function navigateToCertificate5() {
      window.location.href = "http://localhost:3000/ViewTravel.php"; // Replace with the desired URL
    }
    
    
  </script>
</body>
</html>
';
?>