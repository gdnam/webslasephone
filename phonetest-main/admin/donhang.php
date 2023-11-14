<div class="donhang" style="display: block;">
    <table class="table-header">
        <tbody>
            <tr>
                <!-- Theo độ rộng của table content -->
                <th title="Sắp xếp" style="width: 5%" onclick="">Stt <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 5%" onclick="">Mã đơn <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 7%" onclick="">Khách <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 14%" onclick="">Địa Chỉ<i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 19%" onclick="">Sản phẩm <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 10%" onclick="">Tổng tiền <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 10%" onclick="">Ngày giờ <i class="fa fa-sort"></i></th>
                <th title="Sắp xếp" style="width: 10%" onclick="">Trạng thái <i class="fa fa-sort"></i></th>
                <th style="width: 10%">Hành động</th>
            </tr>
        </tbody>
    </table>
    <?php
    require_once ('php/connect.php');
?>


    <div class="table-content" id="table-content">

        <table class="table-outline hideImg">
            <tbody>
                <?php
            $i=1;
            $sql_HD="select * from hoadon order by NgayLap desc";
            $result=mysqli_query($conn,$sql_HD );
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
                    <td style="width: 14%"> <?php echo $row['DiaChi'] .''." [".''."SDT:".''.$row['SDT'].''."]"?></td>
                    <td style="width: 19%">
                        <?php while ($row_ChiTietHD=mysqli_fetch_array($result_ChiTietHD)){?>
                        <?php  $sql_SP="select * from sanpham where MaSP =".''.$row_ChiTietHD['MaSP'];
                    $result_SP=mysqli_query($conn,$sql_SP );
                    $row_SP=mysqli_fetch_array($result_SP)
                    ?>
                        <p style="text-align: right"><?php echo $row_SP['TenSP']?>
                            [<?php echo $row_ChiTietHD['SoLuong']?>]</p>
                        <?php } ?>
                    </td>
                    <td style="width: 10%"><?php echo number_format( $row['TongTien'], 0, ',')?>₫</td>
                    <td style="width: 10%"><?php echo $row['NgayLap']?></td>
                    <td style="width: 10%">
                        <?php  if($row['TrangThai']==0){echo "Đang chờ xử lý";}else if($row['TrangThai']==1){echo "Hoàn Thành";} else{ echo "Không chấp nhận"; }  ?>
                    </td>
                    <td style="width: 10%">
                        <div class="tooltip">
                            <i class="fa fa-check" onclick="duyetDonHang(<?php echo$row['MaHD']  ?>)"></i>
                            <span class="tooltiptext">Duyệt</span>
                        </div>
                        <div class="tooltip">
                            <i class="fa fa-spinner" onclick="choXuLy(<?php echo$row['MaHD']  ?>)"></i>
                            <span class="tooltiptext">Đang xử lý</span>
                        </div>
                        <div class="tooltip">
                            <i class="fa fa-remove" onclick="huy(<?php echo$row['MaHD']  ?>)"></i>
                            <span class="tooltiptext">Hủy</span>
                        </div>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div class="timTheoNgay">
            Từ ngày: <input type="date" id="fromDate">
            Đến ngày: <input type="date" id="toDate">

            <button onclick="locDonHangTheoNgay();"><i class="fa fa-search"></i> Tìm</button>
        </div>

        <select name="kieuTimDonHang" id="kieuTimDonHang">
            <option value="MaHD">Tìm theo mã đơn</option>
            <option value="MaND">Tìm theo tên khách hàng</option>
            <option value="TrangThai">Tìm theo trạng thái</option>
        </select>
        <input type="text" placeholder="Tìm kiếm..." id="NoiDungDonHangTimKiem" onkeyup="timKiemDonHang(this)">
    </div>

</div>