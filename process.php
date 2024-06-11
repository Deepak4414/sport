<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_no = $_POST["reg"];
    $name = $_POST["name"];
    $year = $_POST["year"];
    $branch = $_POST["branch"];
    
    // Handle checkboxes
    if(isset($_POST['events'])) {
        $events = implode(',', $_POST['events']);
    } else {
        $events = null;
    }

    // Check if the registration number already exists
    $checkQuery = "SELECT * FROM event WHERE reg = '$registration_no'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo '<script>alert("Registration Number already exists. Please use a different one.");';
        echo 'window.location.href = "detail.html";</script>';
    } else {
        // Insert the record
        $sql = "INSERT INTO event (reg, name, year, branch, events) VALUES ('$registration_no', '$name', '$year', '$branch', '$events')";

        if ($conn->query($sql) === TRUE) {
            header('location: report.html');
        } else {
            echo '<script>alert("Error: ' . $conn->error . '");</script>';
        }
    }
}

$conn->close();
?>
