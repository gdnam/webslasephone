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
	<link rel="stylesheet" href="css/banner.css">
	<link rel="stylesheet" href="css/taikhoan.css">
	<link rel="stylesheet" href="css/trangchu.css">
	<link rel="stylesheet" href="css/home_products.css">
	<link rel="stylesheet" href="css/pagination_phantrang.css">
	<link rel="stylesheet" href="css/footer.css">
<!--	 js-->
	<script src="js/classes.js"></script>
	<script src="js/dungchung.js"></script>

<!--	<script src="data/products.js"></script>-->




</head>

<body>

<?php include('php/connect.php') ?>


	<section>
        <!--  Header -->
        <?php require_once ('dungchung/header.php')?>
        <!--  End Header -->
        <!--  Banner -->
		<div class="banner">
			<div class="owl-carousel owl-theme"></div>
		</div> <!-- End Banner -->

		<br>
		<div class="companyMenu group flexContain"></div>

		<div class="flexContain">

			<div class="pricesRangeFilter dropdown">
				<button class="dropbtn">Giá tiền</button>
				<div class="dropdown-content"></div>
			</div>

<!--			<div class="promosFilter dropdown">-->
<!--				<button class="dropbtn">Khuyến mãi</button>-->
<!--				<div class="dropdown-content"></div>-->
<!--			</div>-->
<!---->
<!--			<div class="starFilter dropdown">-->
<!--				<button class="dropbtn">Số lượng sao</button>-->
<!--				<div class="dropdown-content"></div>-->
<!--			</div>-->

			<div class="sortFilter dropdown">
				<button class="dropbtn">Sắp xếp</button>
				<div class="dropdown-content"></div>
			</div>


		</div> <!-- End khung chọn bộ lọc -->
		<div>
			<input type="text" class="js-range-slider" id="demoSlider">
		</div>

		<div class="choosedFilter flexContain">
			<a id="deleteAllFilter" style="display: none;">
				<h3>Xóa bộ lọc</h3>
			</a>
		</div> <!-- Những bộ lọc đã chọn -->
		<hr>

		<!-- Mặc định mới vào trang sẽ ẩn đi, nế có filter thì mới hiện lên -->
		<div class="contain-products" style="display:none"> 
			<div class="filterName">
				<input type="text" placeholder="Lọc trong trang theo tên...">
			</div> <!-- End FilterName -->

			<ul id="products" class="homeproduct group flexContain">
				<div id="khongCoSanPham">
					<i class="fa fa-times-circle"></i>
					Không có sản phẩm nào
				</div> <!-- End Khong co san pham -->
			</ul><!-- End products -->

			<div class="pagination"></div>
		</div>

		<!-- Div hiển thị sản phẩm.. -->
		<div class="contain-khungSanPham" id="contain-khungSanPham">
			<?php require_once ('KhungSanPham.php');?>
		</div>

	</section> <!-- End Section -->

<!--	<script>-->
<!--		addContainTaiKhoan(); addPlc();-->
<!--	</script>-->

<div class="plc">
	<section>
		<ul class="flexContain">
			<li>Giao hàng hỏa tốc trong 1 giờ</li>
			<li>Thanh toán linh hoạt: tiền mặt, visa / master, trả góp</li>
			<li>Trải nghiệm sản phẩm tại nhà</li>
			<li>Lỗi đổi tại nhà trong 1 ngày</li>
			<li>Hỗ trợ suốt thời gian sử dụng.
				<br>Hotline:
				<a href="tel:12345678" style="color: #288ad6;">12345678</a>
			</li>
		</ul>
	</section>
</div>

	<div class="footer">
		<!--<script>addFooter(); </script-->
		<!-- ============== Alert Box ============= -->
		<div id="alert">
			<span id="closebtn">&otimes;</span>
		</div>

		<!-- ============== Footer ============= -->
	</div>

	<i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>

<script src="js/trangchu1.js"></script>
</body>

</html>