<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Employed1.css" />
  <style>
    .vector-wrapper {
      cursor: pointer;
    }

    .admin-next,
    .admin-back {
      cursor: pointer;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documentation Request (Employed) pg.1 </title>
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
    <div class="vector-wrapper" onclick="navigateToCertificate1()"><img class="vector" src="img/Star.svg" /></div>
    <p class="text-wrapper-3">CERTIFICATE OF CLOSURE OF BUSINESS/CESSATION OF REGISTRATION</p>
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
    <div class="admin-next" onclick="navigateToNext()">
    <div class="div-wrapper"><div class="text-wrapper-6" onclick="navigateToNext()">Next</div></div>
    </div>
</body>
<script>
function goToUserProfile() {
  window.location.href = "http://localhost:3000/Software%20Design/UserProf.php#";
}

function goToDocumentRequest() {
  window.location.href = "http://localhost:3000/Software%20Design/Employed1.php";
}

function logout() {
  window.location.href = "http://localhost:3000/Software%20Design/Logout.php";
}
  function navigateToCertificate1() {
    window.location.href = "http://localhost:3000/Software%20Design/ClosureDB.php"; // Replace with the desired URL
  }

  function navigateToCertificate2() {
    window.location.href = "http://localhost:3000/Software%20Design/ServiceRecDB.php"; // Replace with the desired URL
  }

  function navigateToCertificate3() {
    window.location.href = "http://localhost:3000/Software%20Design/LeaveDB.php"; // Replace with the desired URL
  }

  function navigateToCertificate5() {
    window.location.href = "http://localhost:3000/Software%20Design/ViewLeave.php"; // Replace with the desired URL
  }

  function navigateToNext() {
    window.location.href = "http://localhost:3000/Software%20Design/Employed2.php"; // Replace with the desired URL
  }

</script>
</html>
';
?>
