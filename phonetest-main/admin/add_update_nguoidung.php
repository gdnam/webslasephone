<?php require_once ('../php/connect.php')?>
<?php
$update_product = (isset($_GET['updateProduct'])) ? $_GET['updateProduct'] : '';
if($update_product) {
    $upID = $_GET['updateProduct'];
    $sql_up = "select * from sanpham where MaSp= " . $upID . "";
    $query_up = mysqli_query($conn, $sql_up);
    $result_up = mysqli_fetch_array($query_up);
}else{
    $result_up['MaSP']='';
    $result_up['MaLSP']='';
    $result_up['TenSP']='';
    $result_up['DonGia']='';
    $result_up['SoLuong']='';
    $result_up['HinhAnh']='';
    $result_up['MaKM']='';
    $result_up['ManHinh']='';
    $result_up['HDH']='';
    $result_up['CamSau']='';
    $result_up['CamTruoc']='';
    $result_up['CPU']='';
    $result_up['Ram']='';
    $result_up['Rom']='';
    $result_up['SDCard']='';
    $result_up['Pin']='';
    $result_up['SoSao']='';
    $result_up['SoDanhGia']='';
    $result_up['TrangThai']='';
}
?>
<span class="close" onclick="this.parentElement.style.transform = 'scale(0)';">×</span>
<form method="post" id="product-form" name="product-form" action="" enctype="multipart/form-data" >
    <table class="overlayTable table-outline table-content table-header">
        <tbody><tr>
            <th colspan="2">Thêm Người Dùng</th>
        </tr>
        <tr>
            <td>Mã người dùng:</td>
            <td><input type="text" id="MaND" name="MaND" disabled style="background-color: #808080;" value="<?php echo $result_up['MaSP']; ?>"></td>
        </tr>
        <tr>
            <td>Họ:</td>
            <td><input type="text" id="HoND" name=" HoND" value="<?php echo $result_up['TenSP']; ?>"></td>
        </tr>
        <tr>
            <td>Tên:</td>
            <td><input type="text" id="TenND" name="TenND" value="<?php echo $result_up['TenSP']; ?>"></td>
        </tr>
        <tr>
            <td>Số điện thoại:</td>
            <td><input type="number" id="Phonenumber"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" id="Email"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Địa chỉ:</td>
            <td><input type="text" id="Address"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Tài Khoản:</td>
            <td><input type="text" id="TaiKhoan"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" id="password"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Nhập lại mật khẩu:</td>
            <td><input type="password" id="rpassword"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
            <tr>
                <td colspan="2" class="table-footer"> <button type="button" onclick="addNguoiDung()">THÊM</button> </td>
            </tr>
        </tbody></table>
</form>
