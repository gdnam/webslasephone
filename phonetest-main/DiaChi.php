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
    <link rel="stylesheet" href="css/delivery.css">
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
<?php
include('php/connect.php');
if (!isset($_SESSION['address'])) {
    $_SESSION['address'] = [];
    $_SESSION['address']['1']= '';
    $_SESSION['address']['2']= '';
    $_SESSION['address']['3']='';
    $_SESSION['address']['4'] = '';
    $_SESSION['address']['5'] = '';
}

?>
<section style="min-height: 85vh">
    <?php require_once ('dungchung/header.php')?>

<!-- -------------delivery icon------ -->
<section class="delivery">
    <div class="container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-delivery delivery-top-item" >
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="delivery-top-adress delivery-top-item" >
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <div class="delivery-top-payment delivery-top-item" >
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------Delivery------ -->
    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <form name="form-diachi"  id="form-diachi" onsubmit="getDiaChi(); return false;" method="post">
                    <p>Vui lòng chọn địa chỉ giao hàng </p>
                    <div class="delivery-content-left-input-top row" >
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Họ<span style="color:red;"></span></label>
                            <input type="text" id="Ho" name="Ho" value="<?php echo $_SESSION['user']['Ho'];?>" required oninvalid="this.setCustomValidity('Hãy nhập họ!')" onchange="this.setCustomValidity('')" type="text">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Tên<span style="color:red;"></span></label>
                            <input type="text" id="Ten" name="Ten" value="<?php echo $_SESSION['user']['Ten'];?>" required oninvalid="this.setCustomValidity('Hãy nhập tên!')" onchange="this.setCustomValidity('')" type="text">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Điện thoại<span style="color:red;"></span></label>
                            <input type="number" name="phone_number" id="phone_number" value="<?php echo $_SESSION['user']['SDT'];?>" required oninvalid="this.setCustomValidity('Hãy nhập số điện thoại!')" onchange="this.setCustomValidity('')" type="number">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Tỉnh/Tp<span style="color:red;"></span></label>
<!--                            <input type="text" name="province" id="province" value="" required oninvalid="this.setCustomValidity('Hãy nhập tỉnh nhập tỉnh/thành phố!')" onchange="this.setCustomValidity('')" type="text">-->
                            <select class="form-control" id="city" aria-label=".form-select-sm" required oninvalid="this.setCustomValidity('Hãy chọn tên tỉnh của bạn!')" oninput="this.setCustomValidity('')">
                                <option value="" selected>Chọn tỉnh thành</option>
                            </select>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Quận/Huyện<span style="color:red;"></span></label>
<!--                            <input type="text" name="district" id="district" value="" required oninvalid="this.setCustomValidity('Hãy nhập quận/huyện !')" onchange="this.setCustomValidity('')" type="text">-->
                            <select class="form-control" id="district" aria-label=".form-select-sm" required oninvalid="this.setCustomValidity('Hãy chọn tên quận huyện của bạn!')" oninput="this.setCustomValidity('')">
                                <option value="" selected>Chọn quận huyện</option>
                            </select>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label  for="">Phường Xã<span style="color:red;"></span></label>
<!--                            <input type="text" name="district" id="district" value="" required oninvalid="this.setCustomValidity('Hãy nhập quận/huyện !')" onchange="this.setCustomValidity('')" type="text">-->
                            <select class="form-control" id="ward" aria-label=".form-select-sm" required oninvalid="this.setCustomValidity('Hãy chọn tên phường xã của bạn!')"oninput="this.setCustomValidity('')">
                                <option value="" selected>Chọn phường xã</option>
                            </select>
                        </div>
                    </div>
                    <div class="delivery-content-left-input-bottom">
                        <label  for="">Địa chỉ cụ thể<span style="color:red;"></span></label>
                        <input type="text" name="specific_address" id="specific_address" value="" required oninvalid="this.setCustomValidity('Hãy điền địa chỉ cụ thể!')" onchange="this.setCustomValidity('')" type="text">
                    </div>
                    <div class="delivery-content-left-button row">
<!--                        <a href="cart.php" style="color:cornflowerblue"><span>&#171;</span><p style="font-size: 14px;">Quay lại giỏ hàng </p></a>-->
                        <button  class="btn btn-outline-danger" type="button" onclick="location.href = 'giohang.php' "><span>&#171;</span><p style="font-size: 14px;">Quay lại giỏ hàng </p></button>
                        <button  class="btn btn-outline-success" type="submit"  onclick=" "><p style="font-weight: bold"><i class="fa fa-usd"></i> THANH TOÁN VÀ GIAO HÀNG</p></button>
                    </div>
                </form>

            </div>

            <div class="delivery-content-right">
                <table style="    font-size: 14px;">

                    <tr>
                        <th>Sản phẩm</th>
                        <th> Số lượng </th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php
                    $tong = 0;
                    if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
                    for ($i=0;$i < sizeof($_SESSION['giohang']);$i++){
                    ?>
                        <tr>
                            <td> <?php echo $_SESSION['giohang'][$i][1] ?></td>
                            <td><?php echo $_SESSION['giohang'][$i][3] ?></td>
                            <td><a><?php echo $_SESSION['giohang'][$i][2] ?><sup>đ</sup></a></td>

                        </tr>
<!--                    <tr>-->
<!--                        <td>Sam sung A12</td>-->
<!--                        <td> 2 </td>-->
<!--                        <td>9999999</td>-->
<!--                    </tr>-->
                    <?php  }
                    }
                    ?>

                    <tr>
                        <td style="font-weight: bold" colspan="2">Tổng</td>
                        <td style="font-weight: bold"><a><?php echo $_SESSION['tong'] ?><sup>đ</sup></a></td>
                    </tr>

                </table>

            </div>
        </div>
    </div>

    </section>
</section>

<!-- -------------footer------ -->
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
</div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/thanhtoan.js"></script>
<script src="js/Jquery/Jquery.min.js"></script>
<script src="js/owlcarousel/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if(this.value != ""){
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }
</script>
</body>
</html>