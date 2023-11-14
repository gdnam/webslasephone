<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin - Thế giới điện thoại</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        crossorigin="anonymous">

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <!-- Our files -->
    <script src="../js/Jquery/Jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/admin/style1.css">
    <link rel="stylesheet" href="css/admin/progress.css">
<!--    <script src="../js/classes.js"></script>-->
<!--    <script src="../js/dungchung.js"></script>-->
    <script src="js/admin.js"></script>
</head>

<body>
    <header>
        <h2>HUST SHOP SMARTPHONE - Admin</h2>
    </header>

    <!-- Menu -->
    <aside class="sidebar">
        <ul class="nav">
            <li class="nav-title">MENU</li>
            <li class="nav-item" onclick="javascrip:gethome()" ><a class="nav-link active"><i class="fa fa-home"></i> Trang Chủ</a></li>
            <li class="nav-item"onclick="javascrip:getsanpham()"><a class="nav-link"><i class="fa fa-th-large"></i> Sản Phẩm</a></li>
            <li class="nav-item" onclick="javascrip:getdonhang()"><a class="nav-link"><i class="fa fa-file-text-o"></i> Đơn Hàng</a></li>
            <li class="nav-item" onclick="javascrip:getkhachhang()"><a class="nav-link"><i class="fa fa-address-book-o"></i> Khách Hàng</a></li>
            <li class="nav-item">
                <hr>
            </li>
            <li class="nav-item">
                <a href="../index.php" class="nav-link" onclick="logOutAdmin(); ">
                    <i class="fa fa-arrow-left"></i>
                    Đăng xuất (về Trang chủ)
                </a>
            </li>
        </ul>
    </aside>
    <!-- Khung hiển thị chính -->
    <div class="main" id="main-content">
        <?php require_once ('home.php')?>


    </div>
</body>

</html>