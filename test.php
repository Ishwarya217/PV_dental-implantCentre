<?php
$conn = new mysqli("localhost", "root", "root", "dental_clinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connected successfully!";
?>
