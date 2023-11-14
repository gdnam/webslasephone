<?php
?>
<div class="header group">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="Trang chủ Smartphone Store" title="Trang chủ Smartphone Store">
        </a>
    </div> <!-- End Logo -->

    <div class="content">
        <div class="search-header">
            <form class="input-search" method="get" action="index.php">
                <div class="autocomplete">
                    <input id="search-box" name="search" autocomplete="off" type="text" placeholder="Nhập từ khóa tìm kiếm...">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                        Tìm kiếm
                    </button>
                </div>
            </form> <!-- End Form search -->
            <div class="tags">
                <strong>Từ khóa: </strong>
            </div>
        </div> <!-- End Search header -->

        <div class="tools-member">
            <div class="member">
                <?php if(isset($_SESSION['user'])){ ?>
                    <a onclick="" id="btnTaiKhoan">
                        <i class="fa fa-user"></i>
                        Tài khoản
                    </a>
                    <div class="menuMember">
                        <a href="nguoidung.php">Trang người dùng</a>
                        <a href="php/unsetSession.php" >Đăng xuất</a>
                    </div>

                <?php }else{ ?>
                    <a onclick="window.location='login.php'" id="btnTaiKhoan">
                        <i class="fa fa-user"></i>
                        Đăng nhập
                    </a>

                <?php } ?>
            </div> <!-- End Member -->

            <div class="cart">
                <a href="giohang.php">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Giỏ hàng</span>
                    <span class="cart-number"></span>
                </a>
            </div> <!-- End Cart -->
            <?php if(isset($_SESSION['user'])){ ?>
            <div class="check-order">
                <a href="DonHang.php">
                    <i class="fa fa-truck"></i>
                    <span>Đơn hàng</span>
                </a>
            </div>
            <?php } ?>
        </div><!-- End Tools Member -->
    </div> <!-- End Content -->
</div> <!-- End Header -->
