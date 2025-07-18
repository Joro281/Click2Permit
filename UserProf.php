<?php
// Replace this with your database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";  

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables to hold error messages
$newPasswordError = "";
$passwordMatchError = "";
$successMessage = "";

// Get the user ID from the session
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: http://localhost:3000/UserLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    $newPassword = $_POST["new_password"];
    $reenteredPassword = $_POST["renew_password"];

    // Check if new password fields are empty
    if (empty($newPassword) || empty($reenteredPassword)) {
        $newPasswordError = "Please fill out both password fields.";
    } elseif ($newPassword !== $reenteredPassword) {
        // Check if passwords match
        $passwordMatchError = "Passwords do not match.";
    } else {
        // Passwords match; update in the database
        $plainTextNewPassword = $newPassword;
        $updateSql = "UPDATE employed SET Password = ? WHERE id = ?";

        $stmt = $conn->prepare($updateSql);
        if ($stmt) {
            $stmt->bind_param("si", $plainTextNewPassword, $user_id);
            if ($stmt->execute()) {
                $successMessage = "Password changed successfully.";
                $pass = $newPassword; // Update the displayed password
            } else {
                $successMessage = "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $successMessage = "Error preparing the statement: " . $conn->error;
        }
    }
}

// Query to retrieve user data from the database
// Replace with the actual user ID
$sql = "SELECT Firstname, Lastname, Middlename, Sex, Status, Email, Password FROM employed WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['Firstname'];
    $last_name = $row['Lastname'];
    $middle_name = $row['Middlename'];
    $sex = $row['Sex'];
    $status = $row['Status'];
    $username = $row['Email'];
    $pass = $row['Password']; // Display the hashed password

    echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/UserProfguide.css" />
  <link rel="stylesheet" href="css/UserProf.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <script>
  function goToUserProfile() {
    window.location.href = "http://localhost:3000/UserProf.php#";
  }

  function goToDocumentRequest() {
    window.location.href = "http://localhost:3000/Employed1.php";
  }

  function logout() {
    window.location.href = "http://localhost:3000/Logout.php";
  }
  function toggleEditability() {
    document.getElementById("new_password").readOnly = !document.getElementById("new_password").readOnly;
    document.getElementById("renew_password").readOnly = !document.getElementById("renew_password").readOnly;
  }

  function validateForm() {
    var newPassword = document.getElementById("new_password").value;
    var reenteredPassword = document.getElementById("renew_password").value;
    var fillInputsError = document.getElementById("error_message_fill_inputs");
    var passwordsDoNotMatchError = document.getElementById("error_message_passwords_do_not_match");
    var successMessage = document.getElementById("success_message");

    // Clear existing messages
    fillInputsError.innerHTML = "";
    passwordsDoNotMatchError.innerHTML = "";
    successMessage.innerHTML = "";

        if (newPassword === "" || reenteredPassword === "") {
            fillInputsError.innerHTML = "Fill out all inputs!";
            fillInputsError.style.display = "block";
            return false;
        } else if (newPassword !== reenteredPassword) {
            passwordsDoNotMatchError.innerHTML = "Passwords do not match";
            passwordsDoNotMatchError.style.display = "block";
            return false;
        } else {
            // Passwords match; show the success message
            successMessage.innerHTML = "Password changed successfully.";
            successMessage.style.display = "block";
            return true; // Allow the form to be submitted
        }
    }
</script>

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
    <div class="rectangle"></div>
    <img class="img" src="img/group-6.png" />
    <div class="text-wrapper-3">PROFILE</div>
      <div class="group-2">
        <div class="input-field">
          <div class="input-with-label">
            <div class="label">First Name</div>
            <div class="input">
              <input type="text" name="first_name" value="' . $first_name . '" readonly>
            </div>
          </div>
        </div>
        <div class="input-field-2">
          <div class="input-with-label">
            <div class="label">Last Name</div>
            <div class="input">
              <input type="text" name="last_name" value="' . $last_name . '" readonly>
            </div>
          </div>
        </div>
        <div class="input-field-3">
          <div class="input-with-label">
            <div class="label">Middle Name</div>
            <div class="input">
              <input type="text" name="middle_name" value="' . $middle_name . '" readonly>
            </div>
          </div>
        </div>
        <div class="input-field-4">
          <div class="input-with-label">
            <div class="label">Sex</div>
            <div class="input">
              <input type="text" name="sex" value="' . $sex . '" readonly>
            </div>
          </div>
        </div>

        <div class="input-field-5">
          <div class="input-with-label">
            <div class="label">Status</div>
            <div class="input">
              <input type="text" name="status" value="' . $status . '" readonly>
            </div>
          </div>
        </div>
      </div>

      <div class="group-3">
      <div class="input-field">
      <div class="input-with-label">
        <div class="label">Password</div>
        <div class="input">
          <input type="password" name="password" value="' . $pass . '" readonly>
        </div>
      </div>
    </div>
    <div class="input-field-2">
    <div class="input-with-label">
    <div class="label">Username</div>
    <div class="input">
    <input type="text" name="user_name" value="' . $username . '" readonly>
  </div>
</div>
</div>
<form method="post" onsubmit="return validateForm()">
<!-- ... (your existing input fields) ... -->
<div class="input-field-6">
    <div class="input-with-label">
        <div class="label">New Password</div>
        <div class="input">
            <input type="password" id="new_password" name="new_password" readonly>
        </div>
    </div>
</div>
<div class="input-field-7">
    <div class="input-with-label">
        <div class="label">Re-Enter New Password</div>
        <div class="input">
            <input type="password" id="renew_password" name="renew_password" readonly>
        </div>
    </div>
</div>
<div id="error_message_fill_inputs" class="message error-message"><?php echo $newPasswordError; ?></div>
<div id="error_message_passwords_do_not_match" class="message error-message"><?php echo $passwordMatchError; ?></div>
<div id="success_message" class="message success-message"></div>

<div class="admin-next">
    <div class="div-wrapper">
        <button type="submit" class="text-wrapper-4">Submit</button>
    </div>
</div>
</form>
<div class="admin-edit">
  <div class="div-wrapper">
    <button type="button" onclick="toggleEditability()" class="text-wrapper-4">Edit</button>
  </div>
</div>
      <div class="text-wrapper-5">Personal Information</div>
      <div class="text-wrapper-6">Personal Account</div>
      </div>
      </div>
      </div>
      </div>
      </div>
</body>
</html>
';

} else {
    echo "User not found!";
}

$conn->close();
?>
