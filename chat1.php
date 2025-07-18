<?php
// Database connection parameters
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

// Fetch data from 'employed' table
$sql_employed = "SELECT Unique_id, Firstname, Lastname FROM employed";
$result_employed = $conn->query($sql_employed);

// Fetch data from 'newemployed' table
$sql_newemployed = "SELECT Unique_id, Firstname, Lastname FROM newemployed";
$result_newemployed = $conn->query($sql_newemployed);

// Combine the results from both tables
$user_data = array();
while ($row = $result_employed->fetch_assoc()) {
    $user_data[] = $row;
}

while ($row = $result_newemployed->fetch_assoc()) {
    $user_data[] = $row;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Real-time Chat</title>
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <div class="details">
                        <span>Admin</span>
                        <p>Active now</p>
                    </div>
                </div>
                <a href = "http://localhost:3000/UserProf1.php"class = "back" >Back</a>
            </header>
            <div class="search">
                <span class="text"></span>
                <input type="text" placeholder="Select User">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="users-list">
                <?php foreach ($user_data as $user): ?>
                    <a href="#">
                        <div class="content">
                            <!-- <img src="img/icon-trash.png" alt=""> -->
                            <div class="details">
                                <span><?= $user['Firstname'] . ' ' . $user['Lastname'] ?></span>
                                <p>This is the text message</p>
                            </div>
                        </div>
                        <div class="status-dot"><i class="fa-solid fa-circle-dot"></i></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</body>
</html>
