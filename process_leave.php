<?php
// Your existing PHP code for database connection and session handling

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if position, department, and as_of are filled
    if (empty($_POST["position"]) || empty($_POST["department"]) || empty($_POST["as_of"])) {
        echo 'Fill out all inputs!';
    } else {
        // Insert data into the leave1 database
        $position = $_POST["position"];
        $department = $_POST["department"];
        $as_of = $_POST["as_of"];

        // Add your SQL query to insert data into the leave1 database
        $sqlInsert = "INSERT INTO leave1 (user_id, position, department, as_of) VALUES ('$userID', '$position', '$department', '$as_of')";

        if ($conn->query($sqlInsert) === TRUE) {
            // Record created successfully
            echo 'success';
        } else {
            // Handle the case where the record could not be created
            echo 'Error creating record: ' . $conn->error;
        }
    }
}
?>