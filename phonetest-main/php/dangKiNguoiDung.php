<?php
require_once ('connect.php');
$Ho=$_POST['Ho'];
$Ten=$_POST['Ten'];
$number_phone=$_POST['phone_number'];
$address=$_POST['address'];
$email=$_POST['Email'];
$TaiKhoan=$_POST['TaiKhoan'];
$password=$_POST['MatKhau'];
$rpassword=$_POST['MatKhau'];

$sql = "SELECT TaiKhoan FROM nguoidung where TaiKhoan='$TaiKhoan'";
$row = mysqli_fetch_array(mysqli_query($conn, $sql));

if ($row) {
    $error = "TaiKhoanDaTonTai";
    echo json_encode ($error);
} else {
        $matkhau=md5($password);
        $sql = "INSERT INTO nguoidung(Ho,Ten,SDT,Email,DiaChi,TaiKhoan,MatKhau,MaQuyen,TrangThai) 
                    VALUES ('$Ho','$Ten','$number_phone','$email','$address','$TaiKhoan','$matkhau','1','1')";
        mysqli_query($conn, $sql);
        $error = "ok";
        echo json_encode ($error);
}