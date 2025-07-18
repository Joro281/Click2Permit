<?php
$error = false; // Flag to track errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (empty($_POST["firstname"]) || empty($_POST["midname"]) || empty($_POST["lastname"])|| empty($_POST["birthdate"])|| empty($_POST["birthplace"])|| empty($_POST["worktime"]) || empty($_POST["email"]) || empty($_POST["password"])|| empty($_POST["sex"])|| empty($_POST["status"])) {
        $error = true;
        $error_message = 'Fill out all inputs!';
    } else {
        // Check if email is empty or invalid
        if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $error_message = 'Email is invalid';
        } else {
            // Database connection parameters
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'admin'; // Database name

            // Create a database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get data from the form
            $firstname = $_POST["firstname"];
            $middlename = $_POST["midname"];
            $lastname = $_POST["lastname"];
            $birthplace = $_POST["birthplace"];
            $birthdate = $_POST["birthdate"];
            $worktime = $_POST["worktime"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $sex = $_POST["sex"];
            $status = $_POST["status"];

            // Generate a unique ID
            $unique_id = uniqid();

            // Determine the appropriate database to insert data
            $targetDatabase = ($worktime == "less than 1 year") ? 'newemployed' : 'employed';

            // Insert data into the appropriate database
            $sql = "INSERT INTO $targetDatabase (Unique_id, Firstname, Middlename, Lastname, Birthplace, Birthdate, Worktime, Sex, Status, Email, Password) VALUES ('$unique_id', '$firstname', '$middlename', '$lastname', '$birthplace', '$birthdate', '$worktime', '$sex', '$status', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                $success_message = 'Record created successfully';

                // Close the database connection
                $conn->close();

                // Redirect to the desired site URL when all conditions are met
                header("Location: http://localhost:3000/UserLogin.php");
                exit();
            } else {
                $error = true;
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/signupguide.css" />
  <link rel="stylesheet" href="css/signup.css" />
  <style>
        a {
            text-decoration: none;
        }
        input.text {
            border: none;
            outline: none;
            color: black;
        }
        .notification {
            position: fixed;
            top: 0px;
            right: 0px;
            z-index: 9999;
            text-align: center;
            background-color: #ff0000;
            color: #fff;
            width: 100%;
            padding: 10px;
            display: none;
        }
    </style>

<script>
        function displayNotification(message, isError) {
            var notification = document.getElementById("notification");
            notification.textContent = message;
            notification.style.backgroundColor = isError ? "#ff0000" : "#00ff00";
            notification.style.display = "block";

            // Automatically hide the notification after a few seconds
            setTimeout(function () {
                notification.style.display = "none";
            }, 3000); // Adjust the time as needed
        }

        function validateForm() {
    var firstname = document.querySelector("input[name=firstname]").value;
    var lastname = document.querySelector("input[name=lastname]").value;
    var midname = document.querySelector("input[name=midname]").value;
    var email = document.querySelector("input[name=email]").value;
    var password = document.querySelector("input[name=password]").value;
    var birthplace = document.querySelector("input[name=birthplace]").value;
    var birthdate = document.querySelector("input[name=birthdate]").value;
    var worktime = document.querySelector("select[name=worktime]").value;

    if (firstname === "" || lastname === "" || midname === "" || birthplace === "" || birthdate === "" || worktime === "" || password === "") {
        displayNotification("Fill out all inputs!", true);
    } else if (!isValidEmail(email)) {
        displayNotification("Invalid email", true);
    } else {
        // Form is valid, submit the form
        document.querySelector("form").submit();
    }
}

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
    </script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUpPage</title>
</head>
<body>
    <div class="frame">
        <div class="overlap-wrapper">
            <div class="overlap">
                <div class="div">
                    <div class="logo-heading-and">
                        <div class="logo">UI</div>
                        <div class="heading">Create Account</div>
                    </div>
                    <form method="POST" action="">
                    <div class="information-field">
                    <div class="input-field">
            <div class="input-with-label">
              <div class="label">Firstname</div>
              <div class="input">
                <div class="content"><input class="text" type="text" name="firstname" /></div>
              </div>
            </div>
          </div>
            <div class="input-field">
              <div class="input-with-label0">
                <div class="label">Lastname</div>
                <div class="input">
                  <div class="content"><input class="text" type="text" name="lastname" /></div>
                </div>
              </div>
            </div>
                <div class="information-field">
                  <div class="input-field">
              <div class="input-with-label1">
                <div class="label">Middlename</div>
                <div class="input">
                  <div class="content"><input class="text" type="text" name="midname" /></div>
                </div>
              </div>
            </div>
            <div class="information-field">
                        <div class="input-field">
              <div class="input-with-label2">
                <div class="label">Birthplace</div>
                <div class="input">
                  <div class="content"><input class="text" type="text" name="birthplace" /></div>
                </div>
              </div>
            </div>
            <div class="input-field">
    <div class="input-with-label3">
        <div class="label">Work Time</div>
        <div class="input">
            <div class="content">
                <select class="text-2" name="worktime">
                    <option value="">Select</option>
                    <option value="less than 1 year">Less than 1 Year</option>
                    <option value="1 year or greater">1 Year or greater</option>
                </select>
            </div>
        </div>
    </div>
</div>
    <div class="information-field">
                        <div class="input-field">
              <div class="input-with-label4">
                <div class="label">Birthdate</div>
                <div class="input">
                  <div class="content"><input class="text" type="date" name="birthdate" /></div>
                </div>
              </div>
            </div>
            <div class="input-field1">
              <div class="input-with-label6">
                <div class="label">Email</div>
                <div class="input">
                  <div class="content"><input class="text" type="email" name="email" /></div>
                </div>
              </div>
              <p class="email-error-message" id="email-error-message"></p>
            </div>
            <div class="input-field1">
              <div class="input-with-label7">
                <div class="label">Password</div>
                <div class="input">
                  <div class="content"><input class="text" type="password" name="password" /></div>
                </div>
              </div>
            </div>
            <div class="input-field-6">
    <div class="input-with-label">
    <div class="label">Sex</div>
    <div class="input">
    <div class="content">
      <select class="text-2" name="sex">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
    </div>
    </div>
    </div>
    <div class="input-field-7">
    <div class="input-with-label">
    <div class="label">Status</div>
    <div class="input">
    <div class="content">
      <select class="text-2" name="status">
        <option value="">Select</option>
        <option value="Married">Married</option>
        <option value="Single">Single</option>
        <option value="Divorced">Divorced</option>
        <option value="Widowed">Widowed</option>
      </select>
    </div>
    </div>
    </div>
    </div>
                        </div>
                        <div class="div-2">
                            <div class="div-2">
                                <!-- Change button type to "button" and add onclick event -->
                                <div class="submit-button" onclick="validateForm()">
                                    <button type="button" name="submit-button" style = "background: transparent; color : #fff ;border: transparent; cursor: pointer;font-size: 18px; ">Create account</button>
                                </div>
                            </div>
                            <p class="supporting-text">
              <span class="span">Already have an account?</span>
              <span class="text-wrapper-3"><a href="http://localhost:3000/index.php">Login here</a></span>
            </p>
            <div class="notification" id="notification"></div>
          </div>
        </div>
      </div>
      <div class="overlap-group-wrapper">
        <div class="overlap-group"><img class="polygon" src="img/polygon-3.svg" /><div class="text-wrapper-4">C</div></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
