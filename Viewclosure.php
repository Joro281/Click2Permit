<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a delete, approve, decline, or add request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $deleteSql = "DELETE FROM closure WHERE ID = '$deleteId'";
        $conn->query($deleteSql);
    } elseif (isset($_POST['approve_id'])) {
        $approveId = $_POST['approve_id'];
        // Update the status in the database to 'Approved'
        $approveSql = "UPDATE closure SET Status = 'Approved' WHERE ID = '$approveId'";
        $conn->query($approveSql);
    } elseif (isset($_POST['decline_id'])) {
        $declineId = $_POST['decline_id'];
        // Update the status in the database to 'Declined'
        $declineSql = "UPDATE closure SET Status = 'Declined' WHERE ID = '$declineId'";
        $conn->query($declineSql);
    } elseif (isset($_POST['notify'])) {
        $notifyId = $_POST['notify_id'];
        $notificationMessage = $_POST['notification_message'];

        // Handle the notification message here, for example, store it in the database
        // or send it through email, depending on your requirements.
        // For now, let's just print the message.
        echo "Notification Message for ID $notifyId: $notificationMessage";
    }
}

// Query to fetch data from the 'leave1' table
$sql = "SELECT * FROM closure";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/ViewClosure.css" />
    <style>
    .rectangle-2 table {
        width: 100%; /* Make the table width 100% to fill the rectangle */
        height: 50%; /* Make the table height 100% to fill the rectangle */
    }

    .notification-form {
        display: none;
    }
    </style>
</head>
<body>
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
                                <th>Position</th>
                                <th>Department</th>
                                <th>From_Date</th>
                                <th>To_Date</th>
                                <th>Request Status</th>
                                <th>Action</th>
                                <th>Approval</th>
                                <th>Decline</th>
                                <th>Notify</th>
                            </tr>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<tr>';
                                echo '<td>' . $row['ID'] . '</td>';
                                echo '<td>' . $row['Lastname'] . '</td>';
                                echo '<td>' . $row['Firstname'] . '</td>';
                                echo '<td>' . $row['Middlename'] . '</td>';
                                echo '<td>' . $row['Sex'] . '</td>';
                                echo '<td>' . $row['Position'] . '</td>';
                                echo '<td>' . $row['Department'] . '</td>';
                                echo '<td>' . $row['From_Date'] . '</td>';
                                echo '<td>' . $row['To_Date'] . '</td>';
                                // Add "Request Status" column
                                echo '<td id="status-'.$row['ID'].'">';
                                if ($row['Status'] === 'Approved') {
                                    echo 'Approved';
                                } elseif ($row['Status'] === 'Declined') {
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
                                // Add notify button and message input
                                echo '<td>
                                <form method="post" action="">
                                    <input type="button" value="Notify" onclick="showNotificationForm(' . $row['ID'] . ')"/>
                                    <div class="notification-form" id="notification-form-' . $row['ID'] . '">
                                        <textarea name="notification_message" placeholder="Enter notification message" style="width: 200px; height: 150px;"></textarea>
                                        <input type="hidden" name="notify_id" value="' . $row['ID'] . '"/>
                                        <input type="submit" name="notify" value="Send"/>
                                        <input type="button" value="Cancel" onclick="cancelNotification(' . $row['ID'] . ')"/>
                                    </div>
                                </form>
                            </td>';
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
        function goBack() {
            window.location.href = "http://localhost:3000/Software%20Design/adminemployed1.php"; // Replace with the URL of the page you want to go back to
        }

        function showNotificationForm(rowId) {
            var notificationForm = document.getElementById("notification-form-" + rowId);
            notificationForm.style.display = "block";
        }

        function cancelNotification(rowId) {
            var notificationForm = document.getElementById("notification-form-" + rowId);
            notificationForm.style.display = "none";
        }

</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
