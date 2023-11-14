<?php require_once('php/connect.php') ?>
 <table class="listSanPham">
			<tbody>
			<tr>
				<th>Sản phẩm</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
				<th>Xóa</th>
			</tr>
            <?php
            $tong = 0;
            $tong_sp=0;
            if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
            for ($i=0;$i < sizeof($_SESSION['giohang']);$i++){
            $tong_sp= (int)$_SESSION['giohang'][$i][3] + $tong_sp;
            $tt =  (int)$_SESSION['giohang'][$i][2]* (int)$_SESSION['giohang'][$i][3];
            $GLOBALS['tong']=$GLOBALS['tong']+$tt;
            ?>
			<tr>
				<td class="noPadding">
					<a target="_blank" href="chitietsanpham.php?id=<?php echo$_SESSION['giohang'][$i][4]?>" title="Xem chi tiết">
						<img class="smallImg" src="<?php echo$_SESSION['giohang'][$i][0] ?>">
						<br>
                        <?php echo$_SESSION['giohang'][$i][1] ?>
					</a>
				</td>
				<td class="alignRight"><?php echo number_format($_SESSION['giohang'][$i][2], 0, ','); ?>₫</td>
				<td class="soluong">
					<button type="button" onclick="javascript:giamsoluong(<?=$i?>)" name="quantity[<?= $i ?>]" ><i class="fa fa-minus"></i></button>
					<input oninput="javascript:updatequantity(this.value)" size="1" value="<?php echo$_SESSION['giohang'][$i][3]  ?>" name="quantity[<?= $i ?>]">
					<button type="button" onclick="javascript:tangSoLuong(<?= $i ?>,<?= $_SESSION['giohang'][$i][4]?>)" name="quantity[<?= $i ?>] "><i class="fa fa-plus"></i></button>
				</td>
				<td class="alignRight"><?php $giatien=$_SESSION['giohang'][$i][3]*$_SESSION['giohang'][$i][2];echo number_format($giatien, 0, ',');?>₫</td>
				<td class="noPadding">
                    <a href="giohang.php?delid=<?php echo $i ?>" onclick="return confirm('bạn có chắc muốn xoá sản phẩm này khỏi giỏ hàng ?')">
					<i class="fa fa-trash"></i>
                    </a>
				</td>
			</tr>
                <?php

            }
            }
            $_SESSION['tong_sp']=$tong_sp;
            $_SESSION['tong'] =$tong;
            ?>

			<tr style="font-weight:bold; text-align:center">
				<td colspan="3">TỔNG TIỀN: </td>
				<td class="alignRight" style="color:red"><?php echo number_format($_SESSION['tong'], 0, ','); ?>₫ </td>
				<td></td>
			</tr>

			<tr>
				<td colspan="5">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="location.href = 'DiaChi.php'">
						<i class="fa fa-usd"></i> Thanh Toán
					</button>

					<button type="button" class="btn btn-danger" onclick="xacnhanxoahet()">
						<i class="fa fa-trash-o" ></i> Xóa hết
					</button>
				</td>
                <script>
                    function xacnhanxoahet(){
                        if (window.confirm("Bạn có chắc muốn xoá sản phẩm này khỏi giỏ hàng?")) {
                            // window.open("exit.html", "Thanks for Visiting!");
                            window.location='giohang.php?delcart=1'

                        }
                    }
                </script>
			</tr>

			</tbody>
		</table>