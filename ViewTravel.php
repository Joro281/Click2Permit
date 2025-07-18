<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);
function getNotificationCount($lastCheckTimestamp) {
    global $conn;

    $countSql = "SELECT COUNT(*) AS new_records FROM travel WHERE created_at > '$lastCheckTimestamp'";
    $countResult = $conn->query($countSql);

    if ($countResult && $countResult->num_rows > 0) {
        $countRow = $countResult->fetch_assoc();
        return $countRow['new_records'];
    }

    return 0;
}

// Get the last check timestamp from the user (you need to store this value somewhere, e.g., in a session)
$lastCheckTimestamp = $_SESSION['last_notification_check'] ?? '0000-00-00 00:00:00';

// Get the notification count
$notificationCount = getNotificationCount($lastCheckTimestamp);

// Update the last check timestamp
$_SESSION['last_notification_check'] = date('Y-m-d H:i:s');
// Check if a delete, approve, decline, or add request is made
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $deleteSql = "DELETE FROM travel WHERE ID = '$deleteId'";
        $conn->query($deleteSql);
    } elseif (isset($_POST['approve_id'])) {
        $approveId = $_POST['approve_id'];
        // Update the request status in the database to 'Approved'
        $approveSql = "UPDATE travel SET Request_Status = 'Approved' WHERE ID = '$approveId'";
        $conn->query($approveSql);
    } elseif (isset($_POST['decline_id'])) {
        $declineId = $_POST['decline_id'];
        // Update the request status in the database to 'Declined'
        $declineSql = "UPDATE travel SET Request_Status = 'Declined' WHERE ID = '$declineId'";
        $conn->query($declineSql);
    }
}

// Query to fetch data from the 'travel' table
$sql = "SELECT * FROM travel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/ViewTravel.css" />
    <style>
            body {
                margin: 0;
            }

            .notification-form {
                display: none;
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
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 325px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                z-index: 1;
                right: 0;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }
            #notificationBell {
        width: 25px;
        height: 25px;
        cursor: pointer; /* Add this line to change the cursor to a pointer */
    }
    .message-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.message-info {
    flex: 1;
}

.timestamp {
    color: #888;
    font-size: 12px;
    display: block;
    margin-top: 5px;
}

.delete-button {
    background-color: #ff5757;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.delete-button:hover {
    background-color: #e74c3c;
}
    /* Add these styles to your existing styles */
    .rectangle-2 {
        overflow: auto;
        width: 800px;
        height: 600px;
        background-color: white; /* Set the background color for the entire table */
    }

    .rectangle-2 table {
        width: 100%;
        border-collapse: collapse;
        background-color: white; /* Set the background color for the entire table */
    }

    .rectangle-2 th,
    .rectangle-2 td {
        border: 1px solid #ddd;
        padding: 16px;
        text-align: left;
        overflow: hidden;
        white-space: nowrap;
        font-size: 15px;
    }

    .rectangle-2 th {
        background-color: #999DA0; /* Header background color */
        color: white;
    }

    .rectangle-2 td {
        background-color: white; /* Set the background color for all rows */
    }

    .rectangle-2 td a {
        color: #3498db; /* Link color */
        text-decoration: none;
    }

    .rectangle-2 td a:hover {
        text-decoration: underline;
    }

    .rectangle-2 td button {
        background-color: #e74c3c; /* Delete button color */
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .rectangle-2 td button:hover {
        background-color: #c0392b;
    }
    .rectangle-2 td:nth-child(8) {
        white-space: pre-line;
    }
    </style>
</head>
<body>
<div class="navbar">
        <a href="#" onclick="goToUserProfileEmployed()">User Profile (Employed)</a>
        <a href="#" onclick="goToUserProfileNewlyEmployed()">User Profile (Newly Employed)</a>
        <a href="#" onclick="goToDocumentRequestEmployed()">Document Requests (Employed)</a>
        <a href="#" onclick="goToDocumentRequestNewlyEmployed()">Document Requests (Newly Employed)</a>
        <a href="#" onclick="goToEmail()">Send Email</a>
        <a href="#" onclick="logout()">Logout</a>
            <div class="dropdown" style="position: absolute; top: 12px; right: 20px;">
                <img src="img/icon-bell.png" alt="Bell Icon" style="width: 25px; height: 25px;" id="notificationBell" onclick="toggleMessages()">
                <div class="dropdown-content" id="notificationMessages">
    <?php
    // Fetch and display messages from the database
    $messagesSql = "SELECT * FROM travel WHERE created_at > '$lastCheckTimestamp'";
    $messagesResult = $conn->query($messagesSql);

    while ($messageRow = $messagesResult->fetch_assoc()) {
        $timestamp = $messageRow['created_at'];
        $formattedTimestamp = date("F j, Y, g:i a", strtotime($timestamp));
        $messageId = $messageRow['ID'];

        echo '<div class="message-container" data-message-id="' . $messageId . '">';
        echo '<div class="message-info">';
        echo '<strong>' . $messageRow['Firstname'] . ' ' . $messageRow['Lastname'] . '</strong> added to Travel Database<br>';
        echo '<span class="timestamp">' . $formattedTimestamp . '</span>';
        echo '</div>';
        echo '<button class="delete-button" onclick="deleteMessage(' . $messageId . ')">Delete</button>';
        echo '</div>';
    }
    ?>
        </div>
</div>
        </div>
    <div class="frame">
        <div class="div">
            <div class="overlap">
                <div class="group">
                    <div class="overlap-group">
                        <img class="group" src="img/group-4.png" />
                    </div>
                </div>
                <div class="admin-back" onclick="goBack()">
                        <div class="div-wrapper"><div class="text-wrapper-6">Back</div></div>
                    </div>
                <div class="overlap-2">
                    <div class="rectangle"></div>
                    <div class="text-wrapper-3">LIST OF REQUESTED DOCUMENTS</div>
                    <div class="rectangle-2">
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Sex</th>
                                <th>Status</th>
                                <th>Destination</th>
                                <th>Purpose</th>
                                <th>From_Date</th>
                                <th>To_Date</th>
                                <th>Request Status</th>
                                <th>Action</th>
                                <th>Approval</th>
                                <th>Decline</th>
                            </tr>
                            <?php
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['Lastname'] . '</td>';
            echo '<td>' . $row['Firstname'] . '</td>';
            echo '<td>' . $row['Middlename'] . '</td>';
            echo '<td>' . $row['Sex'] . '</td>';
            echo '<td>' . $row['Status'] . '</td>';
            echo '<td>' . $row['Destination'] . '</td>';
            echo '<td>' . $row['Purpose'] . '</td>';
            echo '<td>' . $row['From_Date'] . '</td>';
            echo '<td>' . $row['To_Date'] . '</td>';
            // Add "Request Status" column
            echo '<td id="status-'.$row['ID'].'">';
            if ($row['Request_Status'] === 'Approved') {
                echo 'Approved';
            } elseif ($row['Request_Status'] === 'Declined') {
                echo 'Declined';
            } else {
                echo 'No feedback';
            }
            echo '</td>';
            // Add delete button
            echo '<td><form method="post" action=""><input type="hidden" name="delete_id" value="' . $row['ID'] . '"/><input type="submit" value="Delete"/></form></td>';
            // Add approve button
            echo '<td><form method="post" action=""><input type="hidden" name="approve_id" value="' . $row['ID'] . '"/><input type="submit" value="Approve"/></form></td>';
            // Add decline button
            echo '<td><form method="post" action=""><input type="hidden" name="decline_id" value="' . $row['ID'] . '"/><input type="submit" value="Decline"/></form></td>';
            echo '</tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToUserProfileEmployed() {
            window.location.href = "http://localhost:3000/ViewEmployedProf.php";
        }

        function goToUserProfileNewlyEmployed() {
            window.location.href = "http://localhost:3000/ViewNewEmployedProf.php"; // Replace with the desired URL
        }

        function goToDocumentRequestEmployed() {
            window.location.href = "http://localhost:3000/adminemployed1.php";
        }

        function goToDocumentRequestNewlyEmployed() {
            window.location.href = "http://localhost:3000/adminemployed2.php"; // Replace with the desired URL
        }
        function goToEmail() {
            window.location.href = "http://localhost:3000/vendor/form.php"; // Replace with the desired URL
        }
        function logout() {
            window.location.href = "http://localhost:3000/Logout.php";
        }

        function goBack() {
            window.location.href = "http://localhost:3000/adminemployed1.php";
        }
        function toggleMessages() {
    var messagesDropdown = document.getElementById("notificationMessages");

    messagesDropdown.style.display = (messagesDropdown.style.display === "none") ? "block" : "none";

    // You might want to fetch and update the notifications from the server here
    // Example: Fetch notifications and update the dropdown accordingly
}
function deleteMessage(messageId) {
    var confirmDelete = confirm("Are you sure you want to delete this message?");
    
    if (confirmDelete) {
        // Remove the message from the UI
        var messageElement = document.querySelector('.message-container[data-message-id="' + messageId + '"]');
        if (messageElement) {
            messageElement.remove();
        }
    }
}
    </script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
