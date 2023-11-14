<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style3.css">

    <!--boostrap-->
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <!-- ================================================================================================== -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
    />
    <!-- ================================================================================================== -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <!-- ================================================================================================== -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/topnav.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/taikhoan.css">
    <link rel="stylesheet" href="css/trangchu.css">
    <link rel="stylesheet" href="css/home_products.css">
    <link rel="stylesheet" href="css/pagination_phantrang.css">
    <link rel="stylesheet" href="css/footer.css">

</head>
<body >
<?php include('php/connect.php') ?>
<section style="min-height: 85vh">
    <?php require_once('dungchung/header.php') ?>
<!-- -------------payment------ -->
<!-- -------------payment icon------ -->
<section class="payment">
    <div class="container">
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-delivery payment-top-item" >
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="payment-top-adress payment-top-item" >
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <div class="payment-top-payment payment-top-item" >
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------payment------ -->
    <div class="container">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold">Phơng thức giao hàng</p>
                    <div class="payment-content-left-method-delivery-item">
                        <input checked type="radio">
                        <label for=""> Giao hàng chuyển phát nhanh</label>
                    </div>
                </div>
                <div class="payment-content-left-method-payment">
                    <p style="font-weight: bold"> Phương thức thanh toán</p>
                    <div class="payment-content-left-method-payment-item">
                        <input checked type="radio">
                        <label for=""> Thanh toán khi nhận hàng</label>
                    </div>
                </div>
            </div>
            <div class="payment-content-right">
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Mã giảm giá/ Quà tặng">
                    <button for=""><i class="fa fa-check" aria-hidden="true"></i></button>
                </div>
                <div style="font-weight: bold;margin-top: 76px; margin-left: auto;" class="row">Tổng tất cả là:
                    <a style="font-weight: bold;margin-left: 136px; "><a><?php echo $_SESSION['tong'] ?><sup>đ</sup></a></a>
                </div>

            </div>
        </div>
        <div class="payment-content-right-payment">
<!--            <a href="cart.php" style="color:cornflowerblue"><span>&#171;</span><p style="font-size: 14px;">Quay lai gio hang</p></a>-->
            <button  class="btn btn-outline-danger" type="button" onclick="location.href = 'DiaChi.php' "><span>&#171;</span><a style="font-size: 14px;"> Quay lại địa chỉ </a></button>
            <button  class="btn btn-outline-success"  onclick="add_DonHang()";><a style="font-weight: bold"><i class="fa fa-usd"></i> THANH TOÁN</a></button>
        </div>
    </div>
    </section>
</section>
<!-- -------------footer------ -->
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/thanhtoan.js"></script>
<script src="js/Jquery/Jquery.min.js"></script>
<script src="js/owlcarousel/owl.carousel.min.js"></script>
</body>
</html>