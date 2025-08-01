<?php
$error = false; // Flag to track errors
$errorMessage = ''; // Initialize error message
$successMessage = ''; // Initialize success message

session_start(); // Resume the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID
$userID = $_SESSION['user_id'];

// Database connection code (similar to your existing code)
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'admin';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the signup database using the logged-in user's ID
$sql = "SELECT Lastname, Firstname, Middlename, Sex, Status FROM signup WHERE id = $userID";
$result = $conn->query($sql);

if (!$result) {
    // Handle the case where the SQL query has an error
    $error = true;
    $errorMessage = 'Error in SQL query: ' . $conn->error;
} elseif ($result->num_rows > 0) {
    // Fetch data and store it in variables
    $row = $result->fetch_assoc();
    $lastname = $row['Lastname'];
    $firstname = $row['Firstname'];
    $middlename = $row['Middlename'];
    $sex = $row['Sex'];
    $status = $row['Status'];
} else {
    // Handle the case where no data is found
    $error = true;
    $errorMessage = 'No data found in the signup database.';
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if position, department, and as_of are filled
    if (empty($_POST["position"]) || empty($_POST["department"]) || empty($_POST["from_date"]) || empty($_POST["to_date"])) {
        $error = true;
        $errorMessage = 'Fill out all inputs!';
    } else {
        // Insert data into the travel database
        $position = $_POST["position"];
        $department = $_POST["department"];
        $from_date = $_POST["from_date"];
        
        // Format the to_date field before inserting it into the database
        $to_date = date('Y-m-d', strtotime($_POST['to_date']));
        $daily_rate = $_POST["daily_rate"];
  
        $sqlInsert = "INSERT INTO coe2 (Lastname, Firstname, Middlename, Sex, Status, Position, Department, From_Date, To_Date, Daily_Rate) 
                      VALUES ('$lastname', '$firstname', '$middlename', '$sex', '$status', '$position', '$department', '$from_date', '$to_date', '$daily_rate')";
  
        if ($conn->query($sqlInsert) === TRUE) {
            // Record created successfully
            $successMessage = 'Record created successfully, Check your Email for Updates';
        } else {
            // Handle the case where the record could not be created
            $error = true;
            $errorMessage = 'Error creating record: ' . $conn->error;
        }
    }
  }

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/COE.css" />
  <link rel="stylesheet" href="css/Closureguide.css" />
    <style>
        /* Add this CSS to remove the input field outline and spinners */
        input.text-2,
        select.text-2 {
            outline: none;
            border: none;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
        }

        /* Add this CSS to set a hand pointer for the admin buttons */
        .admin-next,
        .admin-back {
            cursor: pointer;
        }

        /* Add this CSS for the error message */
        .error-message {
          color: red;
            position: absolute;
            bottom: 120px; /* Adjust the top position as needed */
            right: 175px; /* Adjust the left position as needed */
            z-index: 9999;
        }

        .error {
            border: 2px solid red;
        }

        .success-message {
            color: green;
            position: absolute;
            bottom: 120px; /* Adjust the top position as needed */
            right: 160px; /* Adjust the left position as needed */
            z-index: 9999;
            display: none;
        }

        .certificate-title {
            font-size: 20px; /* Adjust the font size as needed */
            white-space: nowrap; /* Prevent line break */
        }
        /* Add this CSS for the in-page notification */
        .notification {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            padding: 15px;
            z-index: 1;
            width: 100%;
            display: none;
        }

        .notification.success {
            background-color: #4CAF50;
            color: white;
        }

        .notification.error {
            background-color: #f44336;
            color: white;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Employment</title>
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
            <!-- Change the form method to POST and add the readonly attribute -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="validateFormAndSubmit()">
                <!-- Last Name -->
                <div class="input-field">
                    <div class="input-with-label">
                        <div class="label">Last Name</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="last_name"
                                    value="<?php echo $lastname; ?>" readonly /></div>
                        </div>
                    </div>
                </div>

                <!-- First Name -->
                <div class="input-field-2">
                    <div class="input-with-label">
                        <div class="label">First Name</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="first_name"
                                    value="<?php echo $firstname; ?>" readonly /></div>
                        </div>
                    </div>
                </div>

                <!-- Middle Name -->
                <div class="input-field-5">
                    <div class="input-with-label">
                        <div class="label">Middle Name</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="middle_name"
                                    value="<?php echo $middlename; ?>" readonly /></div>
                        </div>
                    </div>
                </div>
                <!-- Add similar blocks for other fields -->

                <!-- Sex -->
                <div class="input-field-6">
                    <div class="input-with-label">
                        <div class="label">Sex</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="sex"
                                    value="<?php echo $sex; ?>" readonly /></div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="input-field-7">
                    <div class="input-with-label">
                        <div class="label">Status</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="status"
                                    value="<?php echo $status; ?>" readonly /></div>
                        </div>
                    </div>
                </div>

                <div class="input-field-3">
                    <div class="input-with-label">
                        <div class="label">Position</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="position" /></div>
                        </div>
                    </div>
                </div>
                <div class="input-field-4">
                    <div class="input-with-label">
                        <div class="label">Department</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="text" name="department" /></div>
                        </div>
                    </div>
                </div>
                <div class="overlap-3">
                    <div class="input-field-8">
                        <div class="input-with-label">
                            <div class="label">From:</div>
                            <div class="input">
                                <div class="content"><input class="text-2" type="date" name="from_date" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlap-3">
                    <div class="input-field-9">
                        <div class="input-with-label">
                            <div class="label">To:</div>
                            <div class="input">
                                <div class="content"><input class="text-2" type="date" name="to_date" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-field-10">
                    <div class="input-with-label">
                        <div class="label">Daily Rate (PHP)</div>
                        <div class="input">
                            <div class="content"><input class="text-2" type="number" name="daily_rate" /></div>
                        </div>
                    </div>
                </div>
                <div class="text-wrapper-3 certificate-title">Certificate of Employment</div>
                <div class="text-wrapper-4">Personal Information</div>
                <div class="text-wrapper-5">Work Information</div>
                <img class="vector" src="img/Star.svg" />
                <img class="icon-briefcase" src="img/icon-briefcase.png" />
                <img class="icon-person" src="img/icon-person.png" />
                <!-- Change the div-wrapper onclick attribute -->
                <div class="admin-next">
                    <div class="div-wrapper">
                        <button type="submit" class="text-wrapper-7">Submit</button></div>
                </div>
                <div class="admin-back">
                    <div class="div-wrapper"><a href="http://localhost:3000/NewEmployed.php">
                            <div class="text-wrapper-6">Back</div>
                        </a></div>
                </div>
                <!-- Display error and success messages -->
            <!-- Display error message as an in-page notification -->
            <div id="error-notification" class="notification error">
                <?php echo $error ? $errorMessage : ''; ?>
            </div>

            <!-- Display success message as an in-page notification -->
            <div id="success-notification" class="notification success">
                <?php echo $successMessage; ?>
        </div>
            </form>
        </div>
    </div>
        <!-- Add this script to show/hide the success notification -->
        <script>
        window.onload = function () {
            // Display the error notification if it is not empty
            var errorNotification = document.getElementById('error-notification');
            if (errorNotification.innerHTML.trim() !== '') {
                errorNotification.style.display = 'block';
                // Hide the notification after 5 seconds (adjust as needed)
                setTimeout(function () {
                    errorNotification.style.display = 'none';
                }, 5000);
            }

            // Display the success notification if it is not empty
            var successNotification = document.getElementById('success-notification');
            if (successNotification.innerHTML.trim() !== '') {
                successNotification.style.display = 'block';
                // Hide the notification after 5 seconds (adjust as needed)
                setTimeout(function () {
                    successNotification.style.display = 'none';
                }, 5000);
            }
        };
    </script>
</body>

</html>
