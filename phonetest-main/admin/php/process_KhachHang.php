<?php
require_once 'connect.php';
//$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "doiTrangThaiND":
        $result = doiTrangThaiND();
        break;
    case "deleteND":
        $result = deleteND();
        break;
    default:
        break;
}
function doiTrangThaiND()
{
    global $conn;
    $MaND = $_GET['id'];
    $sql = "select * from nguoidung where MaND=" . '' . $MaND;
    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    echo $row['TrangThai'];
    if ($row['TrangThai'] == 1) {
        $sql_trangThai = "update nguoidung set TrangThai = 0 where MaND=" . '' . $MaND;
        mysqli_query($conn, $sql_trangThai);
        echo $sql_trangThai;

    } else {
        $sql_trangThai = "update nguoidung set TrangThai = 1 where MaND=" . '' . $MaND;
        mysqli_query($conn, $sql_trangThai);
        echo $sql_trangThai;
    }
}
function deleteND(){
    global $conn;
    $MaND = $_GET['id'];
    echo $MaND;
    mysqli_query($conn, "DELETE FROM chitiethoadon WHERE MaHD IN (SELECT MaHD FROM hoadon WHERE MaND = $MaND);");
    mysqli_query($conn, "DELETE FROM hoadon WHERE MaND = $MaND;");
    mysqli_query($conn, "DELETE FROM nguoidung WHERE MaND = $MaND;");

}
