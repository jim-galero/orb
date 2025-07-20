<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'orb_retailer'; // Create this in phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
