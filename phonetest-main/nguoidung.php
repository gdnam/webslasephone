<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thế giới điện thoại</title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          crossorigin="anonymous">
    <!-- owl carousel libraries -->
    <link rel="stylesheet" href="js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="js/owlcarousel/owl.theme.default.min.css">
    <script src="js/Jquery/Jquery.min.js"></script>
    <script src="js/owlcarousel/owl.carousel.min.js"></script>

    <!-- Slider -->
    <link href="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.0/css/ion.rangeSlider.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.0/css/ion.rangeSlider.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.0/js/ion.rangeSlider.min.js"></script>

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/topnav.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/taikhoan.css">
    <link rel="stylesheet" href="css/trangchu.css">
    <link rel="stylesheet" href="css/home_products.css">
    <link rel="stylesheet" href="css/pagination_phantrang.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/nguoidung.css">
    <!--	 js-->
    <script src="js/classes.js"></script>
    <script src="js/dungchung.js"></script>
    <script src="js/trangchu1.js"></script>
    <script src="js/nguoidung1.js"></script>




</head>

<body>

<?php require_once('php/connect.php') ?>
<section>
    <!--  Header -->
    <?php require_once ('dungchung/header.php')?>
    <div class="infoUser">
        <hr>
        <table>
            <tbody><tr>
                <th colspan="3">THÔNG TIN KHÁCH HÀNG</th>
            </tr>
            <tr>
                <td>Tài khoản: </td>
                <td> <input type="text" name="TaiKhoan" id="TaiKhoan"  value="<?php echo $_SESSION['user']['TaiKhoan'] ?>" readonly=""> </td>
                <td> <i class="fa fa-pencil" onclick="changeInfo(this, 'username')"></i> </td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td style="text-align: center;">
                    <i class="fa fa-pencil" id="butDoiMatKhau" onclick="openChangePass()"> Đổi mật khẩu</i>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" id="khungDoiMatKhau">
                    <table>
                        <tbody><tr>
                            <td> <div>Mật khẩu cũ:</div> </td>
                            <td> <div><input name="old_password" id="old_password" type="password"></div> </td>
                        </tr>
                        <tr>
                            <td> <div>Mật khẩu mới:</div> </td>
                            <td> <div><input name="new_password" id="new_password"type="password"></div> </td>
                        </tr>
                        <tr>
                            <td> <div>Xác nhận mật khẩu:</div> </td>
                            <td> <div><input name="rnew_password" id="rnew_password" type="password"></div> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div><button onclick="changePass()">Đồng ý</button></div>
                            </td>
                        </tr>
                        </tbody></table>
                </td>
            </tr>
            <tr>
                <td>Họ: </td>
                <td> <input type="text" id="Ho" name="Ho"  value="<?php echo $_SESSION['user']['Ho'] ?>" readonly=""> </td>
                <td> <i class="fa fa-pencil" onclick="changeInfo(this, 'ho')"></i> </td>
            </tr>
            <tr>
                <td>Tên: </td>
                <td> <input type="text" id="Ten" name="Ten"  value="<?php echo $_SESSION['user']['Ten'] ?>" readonly=""> </td>
                <td> <i class="fa fa-pencil" onclick="changeInfo(this, 'ten')"></i> </td>
            </tr>
            <tr>
                <td>Email: </td>
                <td> <input type="text" id="Email" name="Email"  value="<?php echo $_SESSION['user']['Email'] ?>" readonly=""> </td>
                <td> <i class="fa fa-pencil" onclick="changeInfo(this, 'email')"></i> </td>
            </tr>
            <tr>
                <td colspan="3" style="padding:5px; border-top: 2px solid #ccc;"></td>
            </tr>
            <?php $sql_tong="SELECT SUM(cthd.DonGia * cthd.SoLuong) AS TongTien, SUM(cthd.SoLuong) AS SoLuongSanPham FROM ChiTietHoaDon cthd 
                            JOIN HoaDon hd ON cthd.MaHD = hd.MaHD
                            WHERE hd.MaND = '".$_SESSION['user']['MaND']."' and hd.TrangThai=1; ";
                    $result_tong=mysqli_fetch_array(mysqli_query($conn,$sql_tong));
            ?>
            <tr>
                <td>Tổng tiền đã mua: </td>
                <td> <input type="text" value="<?php echo number_format($result_tong['TongTien'], 0, ',');?>₫" readonly=""> </td>
                <td></td>
            </tr>
            <tr>
                <td>Số lượng sản phẩm đã mua: </td>
                <td> <input type="text" value="<?php echo number_format($result_tong['SoLuongSanPham'], 0, ',');?>" readonly=""> </td>
                <td></td>
            </tr>
            </tbody></table></div>




</section> <!-- End Section -->
<i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>


</body>

</html>