<?php require_once ('../php/connect.php')?>

<div class="sanpham" style="display: block">
    <table class="table-header">
        <tbody><tr>
            <!-- Theo độ rộng của table content -->
            <th title="Sắp xếp" style="width: 5%" onclick="sortProductsTable('stt')">Stt <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="sortProductsTable('masp')">Mã <i class="fa fa-sort"></i></th>

            <th title="Sắp xếp" style="width: 30%" onclick="sortProductsTable('ten')">Tên <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="">Số Lượng <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 15%" onclick="sortProductsTable('gia')">Giá <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 15%" onclick="sortProductsTable('khuyenmai')">Khuyến mãi <i class="fa fa-sort"></i></th>
            <th style="width: 15%">Hành động</th>
        </tr>
        </tbody></table>

    <div class="table-content" id="table-content">
        <table class="table-outline hideImg">
            <tbody>
            <?php
                $i=0;
                    $sql_product="select * from sanpham order by MaSP desc";
                    $result=mysqli_query($conn,$sql_product );
            while ($row=mysqli_fetch_array($result)){  ?>
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
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="khungThemSanPham" class="overlay" >
        <?php require_once('add_update_product.php');?>

    </div>

    <div class="table-footer">
        <select name="kieuTimSanPham"id="kieuTimSanPham" >
            <option value="MaSP">Tìm theo mã</option>
            <option value="TenSP">Tìm theo tên</option>
        </select>
        <input type="text" id="TimKiemSanPham"name="TimKiemSanPham" placeholder="Tìm kiếm..." onkeyup="timKiemSanPham(this)">
        <button onclick="viewAddProduct();">
            <i class="fa fa-plus-square"></i>
            Thêm sản phẩm
        </button>
    </div>
</div> <!-- // sanpham -->