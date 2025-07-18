<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['messageId'];

    // Perform the deletion query on the server
    $deleteSql = "DELETE FROM employed WHERE id = '$messageId'";
    $result = $conn->query($deleteSql);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>