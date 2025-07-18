<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/NewlyEmployed.css" />
  <style>
    .vector-wrapper {
      cursor: pointer;
    }
    .admin-back {
      cursor: pointer;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documentation Request (newly employed)</title>
</head>
<body>
  <div class="frame">
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
    <p class="p">What do you want to request?</p>
    <div class="group-2">
    <div class="vector-wrapper" onclick="navigateToCertificate6()"><img class="vector" src="img/Star.svg" /></div>
    <div class="text-wrapper-3" onclick="navigateToCertificate6()">CERTIFICATE OF EMPLOYMENT</div>
    </div>
</body>
<script>
function goToUserProfile() {
  window.location.href = "http://localhost:3000/UserProf1.php#";
}

function goToDocumentRequest() {
  window.location.href = "http://localhost:3000/NewEmployed.php";
}

function logout() {
  window.location.href = "http://localhost:3000/Logout.php";
}
  function navigateToCertificate6() {
    window.location.href = "http://localhost:3000/COEDB2.php"; // Replace with the desired URL
  }

</script>
</html>
';
?>
