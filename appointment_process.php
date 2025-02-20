<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['name'], $_POST['email'], $_POST['date'], $_POST['time'])) {
        die(" Missing form fields!");
    }

    $servername = "localhost";  // Change to 127.0.0.1 if needed
    $username = "root";
    $password = "";  // Leave empty if no password
    $dbname = "dental_clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(" Database Connection Failed: " . $conn->connect_error);
    }

    // Get form data securely
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);

    // Use Prepared Statements
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, date, time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $date, $time);

    if ($stmt->execute()) {
        echo " Appointment booked successfully!";
    } else {
        echo " Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "❌ Error 405: Invalid request method!";
}
?>
