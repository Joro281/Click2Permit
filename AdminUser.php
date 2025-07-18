<?php
session_start(); // Start a session to store user information

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin";

    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM signup WHERE Email = :email AND Password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Check if a user was found
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // User is authenticated, store user information in the session
        $_SESSION['user_id'] = $user['id'];

        // Redirect to the desired site URL
        header("Location: http://localhost:3000/Software%20Design/DocReq.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $error_message = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/Aloginguide.css" />
  <link rel="stylesheet" href="css/ALogin.css" />
  <style>
    /* Add this CSS to remove the input field outline */
    input.content {
      outline: none;
      border: none;
    }

    /* Add CSS styles for error messages */
    .error-message {
      color: red;
      position: absolute; /* Change this to 'relative' or 'fixed' based on your layout */
      top: 50px; /* Adjust the top position */
      left: -60px; /* Adjust the left position */

    
}
    </style>
    <script>
    function redirectToPasswordReset() {
      window.location.href = 'http://example.com/password-reset';
    }
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
</head>
<body>
  <div class="frame">
    <div class="div">
      <div class="overlap">
        <div class="login-field">
          <div class="logo-heading-and">
            <div class="logo">Admin</div>
            <div class="heading">Login to Your Account</div>
          </div>
          <form method="post" action="">
            <div class="information-field">
              <div class="input-field">
                <div class="input-with-label">
                  <div class="label">Email</div>
                  <div class="input">
                    <input type="text" class="content" name="email" required>
                  </div>
                </div>
              </div>
              <div class="input-field">
                <div class="input-with-label">
                  <div class="label">Password</div>
                  <div class="input">
                    <input type="password" class="content" name="password" required>
                  </div>
                </div>
              </div>
              <div class="supporting-button">
                <div class="checkbox">
                  <div class="checkbox-base-wrapper"><div class="checkbox-base"></div></div>
                  <div class="text-and-supporting"><div class="text-wrapper">Remember me</div></div>
                </div>
                <button type="button" class="button1" onclick="redirectToPasswordReset()">Forgot your password?</button>
              </div>
            </div>
            <div class="login-button-list">
            <div class="div-wrapper">
              <button type="submit" class="text-wrapper-7">Login</button>
                <p class="supporting-text"><span class="span">Don&#39;t have an account yet?</span><span class="text-wrapper-6">&nbsp;</span>
              <a href="http://localhost:3000/Software%20Design/SignUp.php"style="text-decoration: none;"> <span class="text-wrapper-8">Sign up here</span>
            </p>
          </a>
            </div>
          </form>
          <p class="error-message" id="error-message"><?php if (isset($error_message)) echo $error_message; ?></p>
        </div>
        <img class="cover-photo" src="img/cover-photo.png" />
        <div class="overlap-group-wrapper">
          <div class="overlap-group"><img class="polygon" src="img/polygon-3.svg" /><div class="text-wrapper-2">C</div></div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
