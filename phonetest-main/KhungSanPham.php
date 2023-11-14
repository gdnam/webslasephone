<?php  require_once('php/connect.php') ?>
<div class="khungSanPham" style="border-color:#ff9c00" >
    <h3 class="tenKhung" style="background-image: linear-gradient(120deg,#ff9c00 0%, #ec1f1f 50%,#ff9c00 100%);">Sản Phẩm Của Cửa Hàng</h3>
    <div class="listSpTrongKhung flexContain" data-tenkhung="NỔI BẬT NHẤT">
        <?php

        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        $min = (isset($_GET['min'])) ? $_GET['min'] : '';
        $max = (isset($_GET['max'])) ? $_GET['max'] : '';
        $searchCompany = (isset($_GET['searchCompany'])) ? $_GET['searchCompany'] : '';
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : '10';


        $type = (isset($_GET['type'])) ? $_GET['type'] : '';
        $nameFilter= (isset($_GET['nameFilter'])) ? $_GET['nameFilter'] : '';

        if ($type!='' and $nameFilter!=''){
            $xapsep="order by $nameFilter $type";
        }else{
            $xapsep="order by MaSP desc";
        }

        $sql_product="select * from sanpham $xapsep limit $limit ";
        $sql_product1="select * from sanpham order by MaSP";
        $afterLimit=$limit+10;
        if ($type!='' and $nameFilter!=''){
            $afterLimit="$afterLimit&type=$type&nameFilter=$nameFilter";
        }
        $Khoanggia='1';
        if($min!='' and $max!=''){
            if($max==0){
                $Khoanggia= "DonGia >$min";
            }else{
                $Khoanggia= "DonGia< $max and DonGia >$min";

            }
            $sql_product="select * from sanpham where $Khoanggia $xapsep limit $limit ";
            $sql_product1="select * from sanpham where $Khoanggia $xapsep ";
            $afterLimit="$afterLimit&max=$max&min=$min";
            if ($type!='' and $nameFilter!=''){
                $afterLimit="$afterLimit&type=$type&nameFilter=$nameFilter";
            }
        }
        if($searchCompany!='' ){
            $sql_loaisp="select * from loaisanpham where TenLSP like '$searchCompany' ";
            $q_lsp=mysqli_query($conn,$sql_loaisp);
            $result_lsp=mysqli_fetch_array($q_lsp);
            $locLSP= "MaLSP like '".$result_lsp['MaLSP']."'";
            $sql_product="select * from sanpham where $Khoanggia and $locLSP $xapsep limit $limit ";
            $sql_product1="select * from sanpham where $Khoanggia and $locLSP $xapsep";
            $afterLimit="$afterLimit&searchCompany=$searchCompany";
            if ($type!='' and $nameFilter!=''){
                $afterLimit="$afterLimit&type=$type&nameFilter=$nameFilter";
            }
        }
        if($search!='' ){
            $sql_loaisp="select * from loaisanpham where TenLSP like '$search' ";
            $q_lsp=mysqli_query($conn,$sql_loaisp);
            $result_lsp=mysqli_fetch_array($q_lsp);
            $locLSP='';
            if(isset($result_lsp['MaLSP'])) {
                $locLSP = "MaLSP like '" . $result_lsp['MaLSP'] . "'or";
            }
            $sql_product="select * from sanpham where $Khoanggia and ($locLSP  TenSP like '%$search%')    $xapsep limit $limit ";
            $sql_product1="select * from sanpham where $Khoanggia and ($locLSP  TenSP like '%$search%')    $xapsep";
            $afterLimit="$afterLimit&search=$search";
            if ($type!='' and $nameFilter!=''){
                $afterLimit="$afterLimit&type=$type&nameFilter=$nameFilter";
            }
        }
        $result=mysqli_query($conn,$sql_product );?>
        <?php while ($row=mysqli_fetch_array($result)){?>
            <li class="sanPham">

                <a href="chitietsanpham.php?id=<?php echo$row['MaSP']  ?>">
                    <img src="<?php echo $row['HinhAnh'] ?>" alt="">
                    <h3><?php echo $row['TenSP'] ?></h3>
                    <div class="price">
                        <strong><?php echo number_format($row['DonGia'], 0, ',');?>₫</strong>
                        <span><?php $DonGia1=$row['DonGia']+$row['MaKM']; echo number_format($DonGia1, 0, ',');?>₫</span>
                    </div>
                    <label class="giamgia">
                        <i class="fa fa-bolt"></i> Giảm <?php echo number_format($row['MaKM'], 0, ',');?>₫
                    </label>
                </a>
            </li>
        <?php }?>

        <?php $sql_max_sp="select count(*) as maxsp from ($sql_product1) AS subquery; ";
            $max_sp=mysqli_fetch_array(mysqli_query($conn,$sql_max_sp ));
        ?>

    </div>
    <?php  if($max_sp['maxsp']==0){?>
    <a class="xemTatCa" onclick="" style="	border-left: 2px solid #ff9c00;
					border-right: 2px solid #ff9c00;">
        Không có sản phẩm nào thỏa mãn yêu cầu
    </a>
    <?php }else if($max_sp['maxsp']<= $limit){
        ?>
        <a class="xemTatCa" onclick="" style="	border-left: 2px solid #ff9c00;
					border-right: 2px solid #ff9c00;">
            Bạn đã xem tất cả sản phẩm
        </a>
    <?php }else{ ?>
    <a class="xemTatCa" onclick="javascrip:xemThemSP(`<?php echo 'limit='.''.$afterLimit ?>`)" style="	border-left: 2px solid #ff9c00;
					border-right: 2px solid #ff9c00;">
        Xem thêm sản phẩm
    </a>
    <?php } ?>


</div>