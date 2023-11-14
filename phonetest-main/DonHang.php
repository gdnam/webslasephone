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
    <link rel="stylesheet" href="css/gioHang.css">
    <!--	 js-->
    <script src="js/classes.js"></script>
    <script src="js/dungchung.js"></script>
    <script src="js/trangchu1.js"></script>
    <script src="js/giohang.js"></script>




</head>

<body>

<?php include('php/connect.php') ?>
<section>
    <!--  Header -->
    <?php require_once ('dungchung/header.php')?>
    <div class="listDonHang">
        <?php

        $item_per_page=isset($_GET['per_page']) ? $_GET['per_page'] : "1";;
        $current_page=isset($_GET['page']) ? $_GET['page'] : "1";
        $offset=($current_page-1)*$item_per_page;
        $sql_HD="select * from hoadon where MaND='" . $_SESSION['user']['MaND'] . "' order by NgayLap desc limit ".$item_per_page." offset ".$offset;
        $totalRecord=mysqli_query($conn,"select * from hoadon where MaND='" . $_SESSION['user']['MaND'] . "' ");
        $totalRecord=$totalRecord->num_rows;
        $totalPages=ceil($totalRecord/$item_per_page);
        $result=mysqli_query($conn,$sql_HD );?>
        <?php
        while ($row=mysqli_fetch_array($result)){?>
        <table class="listSanPham">
            <tbody>

            <tr>
                <th colspan="5">
                    <h3 style="text-align:center;"><?php echo $row['NgayLap']?></h3>
                </th>
            </tr>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
<!--                <th>Thời gian thêm vào giỏ</th>-->
            </tr>
            <tr>

                <?php  $sql_ChiTietHD="select * from chitiethoadon where MaHD =".''.$row['MaHD'];
                $result_ChiTietHD=mysqli_query($conn,$sql_ChiTietHD );
                $i=1;
                while ($row_ChiTietHD=mysqli_fetch_array($result_ChiTietHD)){
                    $sql_SP = "select * from sanpham where MaSP =" . '' . $row_ChiTietHD['MaSP'];
                    $result_SP = mysqli_query($conn, $sql_SP);
                    $row_SP = mysqli_fetch_array($result_SP);

                ?>
                    <td><?php  echo $i++ ?></td>
                <td class="noPadding imgHide">
                    <a target="_blank" href="chitietsanpham.html?id=" title="Xem chi tiết">
                        <?php echo $row_SP['TenSP']?>
                        <img src="<?php echo $row_SP['HinhAnh']?>">
                    </a>
                </td>
                <td class="alignRight"><?php echo number_format($row_ChiTietHD['DonGia'], 0, ',');?>₫</td>
                <td class="soluong">
                    <?php echo $row_ChiTietHD['SoLuong']?>
                </td>
                <td class="alignRight"><?php echo $row_ChiTietHD['SoLuong']*$row_ChiTietHD['DonGia']?> ₫</td>
<!--                <td style="text-align: center">7/3/2023, 9:18:18 PM</td>-->
            </tr>
                <?php } ?>


            <tr style="font-weight:bold; text-align:center; height: 4em;">
                <td colspan="3">TỔNG TIỀN: </td>
                <td class="alignRight"><?php echo number_format($row['TongTien'], 0, ','); ?>₫</td>
                <td> <?php  if($row['TrangThai']==0){echo "Đang chờ xử lý";}else if($row['TrangThai']==1){echo "Hoàn Thành";} else{ echo "Không chấp nhận"; }  ?> </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <?php } ?>
        <div id="pagination">
        <?php if($current_page>3){ ?>
            <a class="page-item" href="?per_page=1&page=1">First</a>
        <?php } ?>
        <?php for ($num=1;$num<=$totalPages;$num++){ ?>
                <?php if($num!=$current_page){ ?>
                    <?php if($num > $current_page-3 && $num <$current_page+3){ ?>
                <a class="page-item" href="?per_page=<?=$item_per_page ?>&page=<?=$num ?>"><?=$num ?></a>
                        <?php }?>

                <?php }else{ ?>
                <strong class="current-page page-item"><?=$num ?> </strong>
            <?php } ?>
        <?php } ?>
        <?php if($current_page<=$totalPages-3){ ?>
            <a class="page-item" href="?per_page=<?=$item_per_page ?>&page=<?=$totalPages?>">Last</a>
        <?php } ?>
        </div>
    </div>




</section> <!-- End Section -->

<!--	<script>-->
<!--		addContainTaiKhoan(); addPlc();-->
<!--	</script>-->

<!--<div class="plc">-->
<!--    <section>-->
<!--        <ul class="flexContain">-->
<!--            <li>Giao hàng hỏa tốc trong 1 giờ</li>-->
<!--            <li>Thanh toán linh hoạt: tiền mặt, visa / master, trả góp</li>-->
<!--            <li>Trải nghiệm sản phẩm tại nhà</li>-->
<!--            <li>Lỗi đổi tại nhà trong 1 ngày</li>-->
<!--            <li>Hỗ trợ suốt thời gian sử dụng.-->
<!--                <br>Hotline:-->
<!--                <a href="tel:12345678" style="color: #288ad6;">12345678</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </section>-->
<!--</div>-->
<!---->
<!--<div class="footer">-->
    <!--<script>addFooter(); </script-->
    <!-- ============== Alert Box ============= -->
<!--    <div id="alert">-->
<!--        <span id="closebtn">&otimes;</span>-->
<!--    </div>-->
<!---->
    <!-- ============== Footer ============= -->
<!--</div>-->

<i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>


</body>

</html>
