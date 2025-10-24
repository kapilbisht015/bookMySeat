<?php
$host = "localhost";
$user = "root";   // laragon/wamp/xampp default
$pass = "1234";
$dbname = "bookmyshow_clone";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
