<?php
switch ($_GET['action']) {
    case "getSessionPhuongThuc":
        $result = getSessionPhuongThuc();
        break;
    case "getSessionDiaChi":
        $result = getSessionDiaChi();
        break;
    case "addGioHangSQL":
        $result = addGioHangSQL();
        break;
    default:
        break;
}
function getSessionDiaChi(){

    require_once("connect.php");
    $_SESSION['diachi']['Ho'] = $_POST['Ho'];
    $_SESSION['diachi']['Ten'] = $_POST['Ten'];
    $_SESSION['diachi']['phone_number'] = $_POST['phone_number'];
    $_SESSION['diachi']['city'] = $_POST['city'];
    $_SESSION['diachi']['district'] = $_POST['district'];
    $_SESSION['diachi']['ward'] = $_POST['ward'];
    $_SESSION['diachi']['specific_address'] = $_POST['specific_address'];
}
function getSessionPhuongThuc(){

    require_once("connect.php");
}
function addGioHangSQL(){
    require_once("connect.php");
    $HovaTen= $_SESSION['diachi']['Ho'] .''. " ".''.$_SESSION['diachi']['Ten'];
    $DiaChi= $_SESSION['diachi']['specific_address'] .''." - ".''. $_SESSION['diachi']['ward'].''. " - " .''.$_SESSION['diachi']['district'].''. " - " .''.$_SESSION['diachi']['city'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
   $sql_giohang=" insert into hoadon(MaND,NgayLap,NguoiNhan,SDT,DiaChi,PhuongThucTT,TongTien,TrangThai) values(
                                                '" . $_SESSION['user']['MaND'] . "',
                                                '" .date("Y-m-d h:i:sa"). "',
                                                '".$HovaTen."',
                                                '".$_SESSION['diachi']['phone_number']."',
                                                '".$DiaChi."',
                                                'Thanh toán khi nhận hàng',
                                                '".$_SESSION['tong']."',
                                                '0'
                                                ) ";
   mysqli_query($conn,$sql_giohang);

    $sql1 = "SELECT MAX(MaHD) FROM hoadon";
    $hoadon = mysqli_query($conn, $sql1);
    $order_id1 = mysqli_fetch_array($hoadon);
    $id=$order_id1['MAX(MaHD)'];
    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        $sql_order_detail = "insert into chitiethoadon (MaHD,MaSP,SoLuong,DonGia)
        values('" . $id . "','" . $_SESSION['giohang'][$i][4] . "','" .  $_SESSION['giohang'][$i][3] . "','" .  $_SESSION['giohang'][$i][2] . "')";
        mysqli_query($conn, $sql_order_detail);
    }
    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        $sql_bandau="select * from sanpham where MaSP='".$_SESSION['giohang'][$i][4]."'";
        $sl = mysqli_query($conn, $sql_bandau);
        $sl1 = mysqli_fetch_array($sl);
        $sql_giam_sp="update sanpham set SoLuong ='".$sl1['SoLuong']-$_SESSION['giohang'][$i][3]."' where MaSP='".$_SESSION['giohang'][$i][4]."' ";
        mysqli_query($conn, $sql_giam_sp);
    }
    unset($_SESSION["giohang"]);
    unset($_SESSION["diachi"]);
}
