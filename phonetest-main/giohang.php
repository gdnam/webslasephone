<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="img/favicon.ico" />

	<title>Thế giới điện thoại</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Load font awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
	 crossorigin="anonymous">
	<!-- -->

	<!-- ================================================================================================== -->
	<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
	/>

    <script src="js/Jquery/Jquery.min.js"></script>
    <script src="js/owlcarousel/owl.carousel.min.js"></script>

	<!-- icon-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- our files -->
	<!-- css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/topnav.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/taikhoan.css">
	<link rel="stylesheet" href="css/gioHang.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/style3.css">
	<!-- js -->
<!--	<script src="data/products.js"></script>-->
<!--	<script src="js/classes.js"></script>-->
<!--	<script src="js/dungchung.js"></script>-->
</head>

<body>
<?php require_once('php/connect.php') ?>
<?php
//                        làm rỗng giỏ hàng
                            if(isset($_GET['delcart'])&&($_GET['delcart']==1)) unset($_SESSION['giohang']);
                        //xóa sp trong giỏ hàng
                        if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
                            array_splice($_SESSION['giohang'], $_GET['delid'], 1);
                        }
                        $cart_id = isset($_GET['addMaSP']) ? $_GET['addMaSP'] : "";
                        $user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
                        if (!isset($_SESSION['giohang'])) {
                            $_SESSION['giohang'] = [];
                        }
                        if (isset($cart_id)) {
                            $sanpham_id = $cart_id;
                            $query = " select * from sanpham where MaSP='" . $sanpham_id . "'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $sanpham_id = $row['MaSP'];
                                $sanpham_TenSP=$row['TenSP'];
                                $sanpham_dongia = $row['DonGia'];
                                $quantity = 1;
                                if ($quantity> $row['SoLuong'] ){

                                }else {
                                    $sanpham_HinhAnh= $row['HinhAnh'];
                                    //        kiem tra sp co trong gio hang

                                    $f1 = 0; // kiem tra sp co trung trong gio hang khong
                                    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                                        if ($_SESSION['giohang'][$i][4] == $sanpham_id) {
                                            $f1 = 1;

                                            $sql="SELECT `SoLuong` FROM `sanpham` WHERE `MaSP` ='$sanpham_id'"  ;
                                            $addProduct = mysqli_query($conn, $sql);
                                            $addProduct = mysqli_fetch_array($addProduct);
                                            if ($_SESSION["giohang"][$i][3]+1 > $addProduct['SoLuong']) {
                                                echo '<script type="text/javascript">alert("Số lượng sản phẩm trong kho không đủ");</script>';
                                            }else {
                                                echo '<script type="text/javascript">alert("Số lượng sản phẩm trong kho không đủ");</script>';
                                                $quantitynew = $quantity + $_SESSION['giohang'][$i][3];
                                                $_SESSION['giohang'][$i][3] = $quantitynew;
                                                break;
                                            }


                                        }
                                    }
                                    // neu khong co thi them moi
                                    if ($f1 == 0) {

                                        //them sp moi vao gio hang
                                        $sp = [$sanpham_HinhAnh, $sanpham_TenSP, $sanpham_dongia, $quantity, $sanpham_id];
                                        $_SESSION['giohang'][] = $sp;
                                    }


                                }

                            }
                        }
?>

	<section style="min-height: 85vh">
        <!--  Header -->
        <?php require_once ('dungchung/header.php')?>
        <!--  End Header -->

		<div class="container">
			<div class="cart-top-wrap">
				<div class="cart-top">
					<div class="cart-top-cart cart-top-item" >
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="cart-top-adress cart-top-item" >
						<i class="fa fa-map-marker" aria-hidden="true"></i>
					</div>
					<div class="cart-top-payment cart-top-item" >
						<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
					</div>
				</div>
			</div>

		</div>
        <form id="cart-form" action="index.php" method="POST">
       <?php include('card-form.php')?>
        </form>
		
	</section> <!-- End Section -->





	<div class="footer">
		<!--<script>addFooter(); </script-->
		<!-- ============== Alert Box ============= -->
		<div id="alert">
			<span id="closebtn">&otimes;</span>
		</div>

		<!-- ============== Footer ============= -->
	</div>

	<i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>

<script src="js/giohang.js"></script>

</body>

</html>