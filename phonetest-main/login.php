<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Phone Sell</title>
    <link rel="stylesheet" href="css/login.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>


</head>

<body>

    <?php
    include('php/connect.php');
    ?>

    <div class="demo-wrap">
        <div class="demo-content">
        </div>
    </div>
    <!--<h2>Weekly Coding Challenge #1: Sign in/up Form</h2>-->
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="login.php" method="post">
                <h1>Tạo tài khoản mới</h1>
                <input type="text" placeholder="Ho" name="Ho" id="Ho" "/>
            <input type=" text" placeholder="Ten" name="Ten" id="Ten""/>
            <input type=" number" placeholder="Số điện thoại" name="phone_number" id="phone_number" "/>
            <input type=" text" placeholder="Address" name="address" id="address" )" />

                <input type="email" placeholder="Email" name="email" id="email" required oninvalid="" />
                <input type="text" placeholder="Tài Khoản" name="TaiKhoan_DangKi" id="TaiKhoan_DangKi" "/>
            <input type=" password" placeholder="Password" name="password_DangKi" id="password_DangKi" "/>
            <input type=" password" placeholder="Re-Password" name="rpassword" id="rpassword""/>

            <div class=" button-ok">
                <a href="index.php"><button type="button">Cancel</button></a>
                <button type="button" onclick="add_NguoiDung()">Sign Up</button>
        </div>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="login.php" method="post">
            <h1>Đăng nhập </h1>
            <?php
            if (isset($_POST['TaiKhoan']) and isset($_POST['password'])) {
                $TaiKhoan = $_POST['TaiKhoan'];
                $password = $_POST['password'];
                $md5password = md5($password);
                $result = mysqli_query($conn, "SELECT * FROM nguoidung where TaiKhoan='$TaiKhoan' and MatKhau='$md5password'");
                $row = mysqli_fetch_array($result);
                if (isset($row['MaQuyen'])) {
                    if ($row['MaQuyen'] == 1) {
                        if ($row['TrangThai'] == 1) {
                            $_SESSION['user'] = $row;
                            header("Location:index.php");
                        } else {
                            echo '<p style="color: red"> Tài khoản của bạn bị khóa</p>';
                        }
                    } else if ($row['MaQuyen'] == 2) {
                        header("Location:admin/admin.php");
                    }
                } else {
                    echo '<p style="color: red">Tài khoản hoặc mật khẩu không chính xác</p>';
                }
            }

            ?>
            <input type="text" placeholder="Tài Khoản" name="TaiKhoan" />
            <input type="password" placeholder="Password" name="password" />
            <a href="#">Quên mật khẩu?</a>
            <div class="button-ok">
                <a href="index.php"><button type="button">Cancel</button></a>
                <button type="submit">Sign in</button>
            </div>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>Để giữ kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                <button class="ghost" id="signIn">Đăng nhập</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
                <button class="ghost" id="signUp">Đăng kí</button>
            </div>
        </div>
    </div>
    </div>

    <script src="js/login.js"></script>
    <script src="js/Jquery/Jquery.min.js"></script>
    <script src="js/owlcarousel/owl.carousel.min.js"></script>
</body>

</html>