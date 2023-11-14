<?php
require_once 'connect.php';
//$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "sanPham":
        $result = sanPham();
        break;
    case "donHang":
        $result = donHang();
        break;
    case "nguoiDung":
        $result = nguoiDung();
        break;
    default:
        break;
}
?>

<?php function sanPham(){
    ?>
<table class="table-outline hideImg">
            <tbody>
            <?php   global $conn;
                    $kieutimkiem = $_GET['kieutimkiem'];
                    $noidungtimkiem = $_GET['noidungtimkiem'];
                    $i=0;
                    $sql_product="select * from sanpham where $kieutimkiem like '%$noidungtimkiem%' order by MaSP asc";
                    $result=mysqli_query($conn,$sql_product );
//                    var_dump($sql_product);
                    if(mysqli_num_rows($result)>0){

                    while ($row=mysqli_fetch_array($result)){ ?>

            <tr>
                <td style="width: 5%"><?php echo($i++) ?></td>
                <td style="width: 10%"><?php echo($row['MaSP']) ?></td>

                <td style="width: 30%">
                    <a title="Xem chi tiết" target="_blank" href="../chitietsanpham.php?id=<?php echo($row['MaSP']) ?>"><?php echo($row['TenSP']) ?></a>
                    <img src="<?php echo("../".$row['HinhAnh']) ?>">
                </td>
                <td style="width: 10%"><?php echo($row['SoLuong']) ?></td>
                <td style="width: 15%"><?php echo( number_format($row['DonGia'], 0, ',')) ?>₫</td>
                <td style="width: 15%">Giảm <?php echo($row['MaKM']) ?>₫</td>
                <td style="width: 15%">
                    <div class="tooltip">
                        <i class="fa fa-wrench" onclick="javascrip:viewProduct(<?php echo($row['MaSP']) ?>)"></i>
                        <span class="tooltiptext">Sửa</span>
                    </div>
                    <div class="tooltip">
                        <i class="fa fa-trash" onclick="deleteProduct(<?php echo($row['MaSP']) ?>)"></i>
                        <span class="tooltiptext">Xóa</span>
                    </div>
                </td>
            </tr>
            <?php }
                    }else{ echo '<div style="text-align: center; color: red;">Không có sản phẩm nào thỏa mãn</div>';}?>
            </tbody>
</table>
<?php } ?>

<?php function donHang(){
    ?>
    <table class="table-outline hideImg">
        <tbody>
        <?php
        global $conn;
        $kieutimkiem = $_GET['kieutimkiem'];
        $noidungtimkiem = $_GET['noidungtimkiem'];
        $tungay= isset($_GET['tungay']) ? $_GET['tungay'] : "";
        $denngay= isset($_GET['denngay']) ? $_GET['denngay'] : "";
        $locngay='';
        if ($tungay!=''and $denngay!=''){
            $locngay="and ('$tungay'<= DATE(NgayLap) and DATE(NgayLap)< '$denngay')";
        }else if($tungay!=''and $denngay==''){
            $locngay="and '$tungay'<= DATE(NgayLap)";
        }else if ($tungay==''and $denngay!=''){
            $locngay="and DATE(NgayLap)<= '$denngay'";
        }

//        echo $kieutimkiem;
        if($kieutimkiem=='MaHD') {
            $sql_HD = "select * from hoadon where $kieutimkiem like'%$noidungtimkiem%' $locngay order by NgayLap desc";
        }else if ($kieutimkiem=='MaND'){
            $nameParts = explode(" ", $noidungtimkiem); // Tách chuỗi thành mảng các phần tử dựa trên khoảng trắng
            $lastName = $nameParts[0]; // Họ
            $firstName = implode(" ", array_slice($nameParts, 1)); // Tên
            $nameParts = explode(" ", $noidungtimkiem); // Tách chuỗi thành mảng các phần tử dựa trên khoảng trắng
            $lastName1 = implode(" ", array_slice($nameParts, 0, -1)); // Họ
            $firstName1 = end($nameParts); // Tên
            $sql_ND="select MaND from nguoidung where (Ho like'%$lastName%' and Ten like '%$firstName%') or (Ho like '%$lastName1%' and Ten like '%$firstName1%') or Ho='$noidungtimkiem' or Ten ='$noidungtimkiem' ";
            $sql_HD = "select * from hoadon where $kieutimkiem in ($sql_ND)  $locngay order by NgayLap desc";

        }else if($kieutimkiem=='TrangThai'){
            $searchTerm = strtolower($noidungtimkiem); // Chuyển đổi chuỗi tìm kiếm thành chữ thường để so sánh không phân biệt hoa thường
            $TraiThaiso=1;
            if($noidungtimkiem==''){
                $kieutimkiem=1;
                $TraiThaiso=1;
            }else if (stripos( 'đang chờ xử lý',$searchTerm) !== false) {
                $TraiThaiso=0;
            } elseif (stripos('hoàn thành',$searchTerm) !== false) {
                $TraiThaiso=1;
            } else if (stripos('không chấp nhận',$searchTerm) !== false) {
                $TraiThaiso=2;
            } else {
            }
            $sql_HD = "select * from hoadon where $kieutimkiem='$TraiThaiso' $locngay order by NgayLap desc";

        }
        $result=mysqli_query($conn,$sql_HD );
        if(mysqli_num_rows($result)>0){
        $i=1;
        while ($row=mysqli_fetch_array($result)){?>
            <tr>
                <td style="width: 5%"><?php echo $i++ ?></td>
                <td style="width: 5%"><?php echo $row['MaHD']?></td>
                <td style="width: 7%">
                    <?php  $sql_ND="select * from nguoidung where MaND =".''.$row['MaND'];
                    $result_ND=mysqli_query($conn,$sql_ND );
                    $row_ND=mysqli_fetch_array($result_ND)
                    ?>
                    <?php echo $row_ND['Ho'].''." ".''.$row_ND['Ten']?>

                </td>

                <?php  $sql_ChiTietHD="select * from chitiethoadon where MaHD =".''.$row['MaHD'];
                $result_ChiTietHD=mysqli_query($conn,$sql_ChiTietHD );
                ?>
                <td style="width: 14%"> <?php echo $row['DiaChi']?></td>
                <td style="width: 19%">
                    <?php while ($row_ChiTietHD=mysqli_fetch_array($result_ChiTietHD)){?>
                        <?php  $sql_SP="select * from sanpham where MaSP =".''.$row_ChiTietHD['MaSP'];
                        $result_SP=mysqli_query($conn,$sql_SP );
                        $row_SP=mysqli_fetch_array($result_SP)
                        ?>
                        <p style="text-align: right"><?php echo $row_SP['TenSP']?> [<?php echo $row_ChiTietHD['SoLuong']?>]</p>
                    <?php } ?>
                </td>
                <td style="width: 10%"><?php echo number_format( $row['TongTien'], 0, ',')?>₫</td>
                <td style="width: 10%"><?php echo $row['NgayLap']?></td>
                <td style="width: 10%"><?php  if($row['TrangThai']==0){echo "Đang chờ xử lý";}else if($row['TrangThai']==1){echo "Hoàn Thành";} else{ echo "Không chấp nhận"; }  ?></td>
                <td style="width: 10%">
                    <div class="tooltip">
                        <i class="fa fa-check" onclick="duyetDonHang(<?php echo$row['MaHD']  ?>)"></i>
                        <span class="tooltiptext">Duyệt</span>
                    </div>
                    <div class="tooltip">
                        <i class="fa fa-spinner" onclick="choXuLy(<?php echo$row['MaHD']  ?>)" ></i>
                        <span class="tooltiptext">Đang xử lý</span>
                    </div>
                    <div class="tooltip">
                        <i class="fa fa-remove" onclick="huy(<?php echo$row['MaHD']  ?>)"></i>
                        <span class="tooltiptext">Hủy</span>
                    </div>

                </td>
            </tr>
        <?php }?>
        <?php }else{ echo '<div style="text-align: center; color: red;">Không có đơn hàng nào thỏa mãn</div>';}?>
        </tbody>
    </table>
<?php } ?>

<?php function nguoiDung(){
    ?>
    <table class="table-outline hideImg"><tbody>
        <?php
        global $conn;
        $kieutimkiem = $_GET['kieutimkiem'];
        $noidungtimkiem = $_GET['noidungtimkiem'];
        $sql_ND="select * from nguoidung where MaQuyen='1'";
        if($kieutimkiem=="HoTen"){
            $nameParts = explode(" ", $noidungtimkiem); // Tách chuỗi thành mảng các phần tử dựa trên khoảng trắng
            $lastName = $nameParts[0]; // Họ
            $firstName = implode(" ", array_slice($nameParts, 1)); // Tên
            $nameParts = explode(" ", $noidungtimkiem); // Tách chuỗi thành mảng các phần tử dựa trên khoảng trắng
            $lastName1 = implode(" ", array_slice($nameParts, 0, -1)); // Họ
            $firstName1 = end($nameParts); // Tên
            $sql_ND="select * from nguoidung where MaQuyen='1' and( (Ho like'%$lastName%' and Ten like '%$firstName%') or (Ho like '%$lastName1%' and Ten like '%$firstName1%') or Ho='$noidungtimkiem' or Ten ='$noidungtimkiem' )";
        }else if ($kieutimkiem=="Email"){
            $sql_ND="select * from nguoidung where MaQuyen='1' and $kieutimkiem like'%$noidungtimkiem%' ";
        }else if($kieutimkiem=="TaiKhoan"){
            $sql_ND="select * from nguoidung where MaQuyen='1' and $kieutimkiem like'%$noidungtimkiem%' ";
        }

        $result=mysqli_query($conn,$sql_ND );
        if(mysqli_num_rows($result)>0){
        $i=1;
        while ($row=mysqli_fetch_array($result)){?>
            <tr>
                <td style="width: 5%"><?php echo $i++ ?></td>
                <td style="width: 10%"><?php echo $row['Ho'].''." ".''.$row['Ten']?></td>
                <td style="width: 10%"><?php echo $row['DiaChi']?></td>
                <td style="width: 10%"><?php echo $row['Email']?></td>
                <td style="width: 10%"><?php echo $row['TaiKhoan']?></td>
                <td style="width: 25%"><?php echo $row['MatKhau']?></td>
                <td style="width: 10%">
                    <div class="tooltip">
                        <label class="switch">
                            <input type="checkbox" <?php if ($row['TrangThai']==1){ echo "checked='checked'";}?> onclick="doiTrangThaiND(<?php echo $row['MaND']?>)">
                            <span class="slider round"></span>
                        </label>
                        <span class="tooltiptext">Khóa</span>
                    </div>
                    <div class="tooltip">
                        <i class="fa fa-remove" onclick="xoaNguoiDung(<?= $row['MaND']?>)"></i>
                        <span class="tooltiptext">Xóa</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <?php
        }else{ echo '<div style="text-align: center; color: red;">Không có người dùng nào thỏa mãn</div>';}?>

        </tbody>
    </table>

<?php } ?>
