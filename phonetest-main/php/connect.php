
<?php
$servername = "localhost";
$database = "web2";
$username = "root";
$password = "";
// Create connection
global $conn;
 $conn = mysqli_connect($servername, $username, $password, $database);
// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Bắt đầu phiên
session_start();
?>