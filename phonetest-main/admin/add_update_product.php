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
            <th colspan="2">Thêm Sản Phẩm</th>
        </tr>
        <tr>
            <td>Mã sản phẩm:</td>
            <td><input type="text" id="MaSP" name="maspThem" disabled style="background-color: #808080;" value="<?php echo $result_up['MaSP']; ?>"></td>
        </tr>
        <tr>
            <td>Tên sản phẩm:</td>
            <td><input type="text" id="TenSP" name=" TenSP" value="<?php echo $result_up['TenSP']; ?>"></td>
        </tr>
        <tr>
            <td>Hãng:</td>
            <td>
                <select name="MaLSP" id="MaLSP" onchange="">
                    <?php
                    $sql_loaisp = "select * from loaisanpham ";
                    $query_loaisp = mysqli_query($conn, $sql_loaisp);
                    while ($row=mysqli_fetch_array($query_loaisp)){
                    if($update_product){ ?>
                        <option value="<?php echo $row['MaLSP'] ?>" <?php if($row['MaLSP']==$result_up['MaLSP']){echo 'selected';}?> ><?php echo $row['TenLSP'] ?></option>
                    <?php }else{?>
                        <option value="<?php echo $row['MaLSP'] ?>"><?php echo $row['TenLSP'] ?></option>

                    <?php }
                    }
                    ?>

                </select>
            </td>
        </tr>
        <tr>
            <td>Hình:</td>
            <td>
<!--                <img class="hinhDaiDien" id="HinhAnh" src="">-->
                <input type="file" id="HinhAnh" <?php if(!$update_product) { ?> required="" <?php } ?> value="<?php echo $result_up['HinhAnh'] ?>" >
            </td>
        </tr>
        <tr>
            <td>Số lượng:</td>
            <td><input type="text" id="SoLuong"  value="<?php echo $result_up['SoLuong']; ?>"></td>
        </tr>
        <tr>
            <td>Giá tiền:</td>
            <td><input type="text" id="DonGia"  value="<?php echo $result_up['DonGia']; ?>"></td>
        </tr>
        <tr>
            <td>Số sao (số nguyên 0-&gt;5):</td>
            <td><input type="text" id="SoSao" value="<?php echo $result_up['SoSao']; ?>"></td>
        </tr>
        <tr>
            <td>Đánh giá (số nguyên):</td>
            <td><input type="text" id="SoDanhGia" value="<?php echo $result_up['SoDanhGia']; ?>"></td>
        </tr>
        <tr>
            <td>Khuyến mãi:</td>
            <td>
                <select>
                    <option value="giamgia">Giảm giá</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Giá trị khuyến mãi:</td>
            <td><input type="text" id="MaKM" placeholder="" value="<?php echo $result_up['MaKM']; ?>"></td>
        </tr>
        <tr>
            <th colspan="2">Thông số kĩ thuật</th>
        </tr>
        <tr>
            <td>Màn hình:</td>
            <td><input type="text" id="ManHinh" value="<?php echo $result_up['ManHinh']; ?>"></td>
        </tr>
        <tr>
            <td>Hệ điều hành:</td>
            <td><input type="text" id="HDH" value="<?php echo $result_up['HDH']; ?>"></td>
        </tr>
        <tr>
            <td>Camara sau:</td>
            <td><input type="text" id="CamSau" value="<?php echo $result_up['CamSau']; ?>"></td>
        </tr>
        <tr>
            <td>Camara trước:</td>
            <td><input type="text" id="CamTruoc" value="<?php echo $result_up['CamTruoc']; ?>"></td>
        </tr>
        <tr>
            <td>CPU:</td>
            <td><input type="text" id="CPU" value="<?php echo $result_up['CPU']; ?>"></td>
        </tr>
        <tr>
            <td>RAM:</td>
            <td><input type="text" id="Ram" value="<?php echo $result_up['Ram']; ?>"></td>
        </tr>
        <tr>
            <td>Bộ nhớ trong:</td>
            <td><input type="text" id="Rom" value="<?php echo $result_up['Rom']; ?>"></td>
        </tr>
        <tr>
            <td>Thẻ nhớ:</td>
            <td><input type="text" id="SDCard" value="<?php echo $result_up['SDCard']; ?>"></td>
        </tr>
        <tr>
            <td>Dung lượng Pin:</td>
            <td><input type="text" id="Pin" value="<?php echo $result_up['Pin']; ?>"></td>
        </tr>
        <?php if($update_product){ ?>
            <tr>
                <td colspan="2" class="table-footer"> <button type="button" onclick="updateProduct()">CẬP NHẬT</button> </td>
            </tr>

        <?php }else{ ?>
        <tr>
            <td colspan="2" class="table-footer"> <button type="button" onclick="addProduct()">THÊM</button> </td>
        </tr>
        <?php } ?>
        </tbody></table>
</form>
