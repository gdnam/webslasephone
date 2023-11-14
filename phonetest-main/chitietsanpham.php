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

	<!-- owl carousel libraries cho hình nhỏ -->
	<link rel="stylesheet" href="js/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="js/owlcarousel/owl.theme.default.min.css">
	<script src="js/Jquery/Jquery.min.js"></script>
    <script src="js/owlcarousel/owl.carousel.min.js"></script>

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/topnav.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/taikhoan.css">
    <link rel="stylesheet" href="css/trangchu.css">
    <link rel="stylesheet" href="css/home_products.css">
    <link rel="stylesheet" href="css/chitietsanpham.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- js -->
    <script src="data/products.js"></script>
    <script src="js/classes.js"></script>
    <script src="js/dungchung.js"></script>
    <script src="js/chitietsanpham.js"></script>
</head>

<body>
    <?php include('php/connect.php') ?>
<section>

        <!--  Header -->
        <?php require_once ('dungchung/header.php')?>
        <!--  End Header -->
    <div class="chitietSanpham" style="min-height: 85vh">
        <?php
        $sanpham_id = (isset($_GET['id'])) ? $_GET['id'] : '';
        ?>
        <?php
        $sql_sanpham="select * from sanpham where MaSP='$sanpham_id'";
        ?>
        <?php $result_sanpham=mysqli_query($conn,$sql_sanpham );?>
        <?php $row_sanpham=mysqli_fetch_array($result_sanpham)?>

        <h1><?php echo $row_sanpham['TenSP'] ?></h1>
        <div class="rowdetail group">
            <div class="picture">
                <img src="<?php echo$row_sanpham['HinhAnh'] ?>">
            </div>
            <div class="price_sale">
                <div class="area_price"><strong><?php echo number_format($row_sanpham['DonGia'], 0, ',');?>₫</strong>
                    <span><?php $DonGia1=$row_sanpham['DonGia']+$row_sanpham['MaKM']; echo number_format($DonGia1, 0, ',');?></span><label class="giareonline">
                        Giá rẻ online
                    </label></div>
                <div class="ship" style="display: none;">
                    <i class="fa fa-clock-o"></i>
                    <div>NHẬN HÀNG TRONG 1 GIỜ</div>
                </div>
                <div class="area_promo">
                    <strong>khuyến mãi</strong>
                    <div class="promo">
                        <i class="fa fa-check-circle"></i>
                        <div id="detailPromo">Cơ hội trúng <span style="font-weight: bold">61 xe Wave Alpha</span> khi trả góp Home Credit</div>
                    </div>
                </div>
                <div class="policy">
                    <div>
                        <i class="fa fa-archive"></i>
                        <p>Trong hộp có: Sạc, Tai nghe, Sách hướng dẫn, Cây lấy sim, Ốp lưng </p>
                    </div>
                    <div>
                        <i class="fa fa-star"></i>
                        <p>Bảo hành chính hãng 12 tháng.</p>
                    </div>
                    <div class="last">
                        <i class="fa fa-retweet"></i>
                        <p>1 đổi 1 trong 1 tháng nếu lỗi, đổi sản phẩm tại nhà trong 1 ngày.</p>
                    </div>
                </div>
                <div class="area_order">
                    <!-- nameProduct là biến toàn cục được khởi tạo giá trị trong phanTich_URL_chiTietSanPham -->
                    <a class="buy_now" onclick="window.location='giohang.php?addMaSP=<?php echo$row_sanpham['MaSP'] ?>' ">
                        <h3><i class="fa fa-plus"></i> Thêm vào giỏ hàng</h3>
                    </a>
                </div>
            </div>
            <div class="info_product">
                <h2>Thông số kỹ thuật</h2>
                <ul class="info"><li>
                    <p>Màn hình</p>
                    <div><?php echo $row_sanpham['ManHinh'] ?></div>
                </li><li>
                    <p>Hệ điều hành</p>
                    <div><?php echo $row_sanpham['HDH'] ?></div>
                </li><li>
                    <p>Camara sau</p>
                    <div><?php echo $row_sanpham['CamSau'] ?></div>
                </li><li>
                    <p>Camara trước</p>
                    <div><?php echo $row_sanpham['CamTruoc'] ?></div>
                </li><li>
                    <p>CPU</p>
                    <div><?php echo $row_sanpham['CPU'] ?></div>
                </li><li>
                    <p>RAM</p>
                    <div><?php echo $row_sanpham['Ram'] ?></div>
                </li><li>
                    <p>Bộ nhớ trong</p>
                    <div><?php echo $row_sanpham['Rom'] ?></div>
                </li><li>
                    <p>Thẻ nhớ</p>
                    <div><?php echo $row_sanpham['SDCard'] ?></div>
                </li><li>
                    <p>Dung lượng pin</p>
                    <div><?php echo $row_sanpham['Pin'] ?></div>
                </li></ul>
            </div>
        </div>
        <hr>
        <div id="goiYSanPham"><div class="khungSanPham" style="border-color: #434aa8">
                <h3 class="tenKhung" style="background-image: linear-gradient(120deg, #434aa8 0%, #ec1f1f 50%, #434aa8 100%);">* Bạn có thể thích *</h3>
                <div class="listSpTrongKhung flexContain">
                    <?php
                    $count_product='select MaSP from sanpham';
                    $count_product1=mysqli_query($conn,$count_product);
                    $arr_r=array();
                    $i=1;
                    while ($count_product2=mysqli_fetch_array($count_product1)){
                        if($count_product2['MaSP']!=$sanpham_id) {
                            $arr_r[$i] = $count_product2['MaSP'];
                            $i++;
                        }
                    }
                    shuffle($arr_r);
                    ?>
                    <?php
                    for ($i=1; $i<=10;$i++){
                    $sql_product1="select * from sanpham where MaSP='$arr_r[$i]'";
                    $result1=mysqli_query($conn,$sql_product1 );
                    $row1= mysqli_fetch_array($result1);
                    ?>
                    <li class="sanPham">
                        <a href="chitietsanpham.php?id=<?php echo$row1['MaSP']  ?>">
                            <img src="<?php echo $row1['HinhAnh'] ?>" alt="">
                            <h3><?php echo $row1['TenSP'];?></h3>
                            <div class="price">
                                <strong><?php echo number_format($row1['DonGia'], 0, ',');?>₫</strong>
                                <span><?php $DonGia1=$row1['DonGia']+$row1['MaKM']; echo number_format($DonGia1, 0, ',');?>₫</span>
                            </div>
                            <label class="giamgia">
                                <i class="fa fa-bolt"></i> Giảm <?php echo number_format($row1['MaKM'], 0, ',');?>₫
                            </label>
                        </a>
                    </li>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
    

<div class="footer">

    <!-- ============== Alert Box ============= -->
    <div id="alert">
        <span id="closebtn">⊗</span>
    </div>

    <!-- ============== Footer ============= --> </div>

<i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>

</body>

</html>