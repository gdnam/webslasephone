
<?php
$servername = "localhost";
$database = "web2";
$username = "root";
$password = "";
// Create connection
global $conn;
$conn = mysqli_connect($servername, $username, $password, $database);

SESSION_START();