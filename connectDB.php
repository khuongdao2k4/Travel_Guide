<?php
// connectDB.php - Kết nối với CSDL travel_guide

$host = 'localhost';
$dbname = 'Smart_Travel_Website';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Kết nối thất bại: ' . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
