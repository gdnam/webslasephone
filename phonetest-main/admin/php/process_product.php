<?php
require_once 'connect.php';
//$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "addproduct":
        $result = addproduct();
        break;
        case "updateProduct":
        $result = updateProduct();
        break;
        case "deleteproduct":
        $result = deleteproduct();
        break;
    default:
        break;
}

function addproduct(){
                    global $conn;
                    $query='';
                    $MaLSP = $_POST['MaLSP'];
                    $TenSP = $_POST['TenSP'];
                    $DonGia = $_POST['DonGia'];
                    $SoLuong = $_POST['SoLuong'];
                    $MaKM = $_POST['MaKM'];
                    $ManHinh = $_POST['ManHinh'];
                    $HDH = $_POST['HDH'];
                    $CamTruoc = $_POST['CamTruoc'];
                    $CamSau = $_POST['CamSau'];
                    $CPU = $_POST['CPU'];
                    $Ram = $_POST['Ram'];
                    $Rom = $_POST['Rom'];
                    $SDCard = $_POST['SDCard'];
                    $Pin = $_POST['Pin'];
                    $SoSao = $_POST['SoSao'];
                    $SoDanhGia = $_POST['SoDanhGia'];
                    $image = $_FILES['HinhAnh']['name'];
                    ////    $image_temp=$_FILES['image']['tmp_name'];
                    //    move_uploaded_file($image_temp , "../$image");
                    if ($_SERVER['REQUEST_METHOD'] !== 'POST')
                    {
                        // Dữ liệu gửi lên server không bằng phương thức post
                        echo "Phải Post dữ liệu";
                        die;
                    }

                    // Kiểm tra có dữ liệu fileupload trong $_FILES không
                    // Nếu không có thì dừng

                    if ($image) {
                        if (!isset($_FILES["HinhAnh"])) {
                            echo "Dữ liệu không đúng cấu trúc";
                            die();
                        }
                        // Kiểm tra dữ liệu có bị lỗi không
                        if ($_FILES["HinhAnh"]['error'] != 0) {
                            echo "Dữ liệu upload bị lỗi";
                            die();
                        }

                        // Đã có dữ liệu upload, thực hiện xử lý file upload

                        //Thư mục bạn sẽ lưu file upload
                        $target_dir = "../../img/products/";
                        //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                        $target_file = $target_dir . basename($_FILES["HinhAnh"]["name"]);

                        $allowUpload = true;

                        //Lấy phần mở rộng của file (jpg, png, ...)
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                        // Cỡ lớn nhất được upload (bytes)
                        $maxfilesize = 800000;

                        ////Những loại file được phép upload
                        $allowtypes = array('jpg', 'png', 'jpeg', 'gif');


                        if (isset($_POST["submit"])) {
                            //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
                            $check = getimagesize($_FILES["image"]["tmp_name"]);
                            if ($check !== false) {
                                echo "Đây là file ảnh - " . $check["mime"] . ".";
                                $allowUpload = true;
                            } else {
                                echo "Không phải file ảnh.";
                                $allowUpload = false;
                            }
                        }

                        // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
                        // Bạn có thể phát triển code để lưu thành một tên file khác
                    //            if (file_exists($target_file)) {
                    //                echo "Tên file đã tồn tại trên server, không được ghi đè";
                    //                $allowUpload = false;
                    //            }
                        // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                        if ($_FILES["HinhAnh"]["size"] > $maxfilesize) {
                            echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
                            $allowUpload = false;
                        }


                        // Kiểm tra kiểu file
                        if (!in_array($imageFileType, $allowtypes)) {
                            echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
                            $allowUpload = false;
                        }


                        if ($allowUpload) {
                            // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                            if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file)) {
                                echo "File " . basename($_FILES["HinhAnh"]["name"]) .
                                    " Đã upload thành công.";

                                echo "File lưu tại " . $target_file;

                                $query = "insert into sanpham (MaLSP ,TenSP,DonGia,SoLuong,HinhAnh,MaKM ,ManHinh,HDH,CamSau,CamTruoc,CPU,Ram,Rom,SDCard,Pin,SoSao,SoDanhGia,TrangThai)
                                values ('" . $MaLSP . "','" . $TenSP . "',
                                        '" . $DonGia . "','" . $SoLuong . "','" . "img/products/".$image . "',
                                        '" . $MaKM . "',
                                        '" . $ManHinh . "','" . $HDH . "','" . $CamSau . "','" . $CamTruoc . "','" . $CPU . "','" . $Ram . "',
                                        '" . $Rom . "','" . $SDCard . "','" . $Pin . "','" . $SoSao . "','" . $SoDanhGia . "','1')";
                            } else {
                                echo "Có lỗi xảy ra khi upload file.";
                            }
                        } else {
                            echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
                        }


                    }
                    $result = mysqli_query($conn, $query);
                    if($result){
                        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],"../../img/products/".$_FILES["HinhAnh"]["tmp_name"]);
                    }


}
function updateproduct(){
    global $conn;
    $query='';
    $MaSP = $_POST['MaSP'];
    $MaLSP = $_POST['MaLSP'];
    $TenSP = $_POST['TenSP'];
    $DonGia = $_POST['DonGia'];
    $SoLuong = $_POST['SoLuong'];
    $MaKM = $_POST['MaKM'];
    $ManHinh = $_POST['ManHinh'];
    $HDH = $_POST['HDH'];
    $CamTruoc = $_POST['CamTruoc'];
    $CamSau = $_POST['CamSau'];
    $CPU = $_POST['CPU'];
    $Ram = $_POST['Ram'];
    $Rom = $_POST['Rom'];
    $SDCard = $_POST['SDCard'];
    $Pin = $_POST['Pin'];
    $SoSao = $_POST['SoSao'];
    $SoDanhGia = $_POST['SoDanhGia'];
    $HinhAnh = $_POST['HinhAnh'];
    echo $HinhAnh;
    if ($HinhAnh){$image=null; }else{
    $image = $_FILES['HinhAnh']['name'];}
    ////    $image_temp=$_FILES['image']['tmp_name'];
    //    move_uploaded_file($image_temp , "../$image");
    if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        // Dữ liệu gửi lên server không bằng phương thức post
        echo "Phải Post dữ liệu";
        die;
    }

    // Kiểm tra có dữ liệu fileupload trong $_FILES không
    // Nếu không có thì dừng

    if ($image) {
        if (!isset($_FILES["HinhAnh"])) {
            echo "Dữ liệu không đúng cấu trúc";
            die();
        }
        // Kiểm tra dữ liệu có bị lỗi không
        if ($_FILES["HinhAnh"]['error'] != 0) {
            echo "Dữ liệu upload bị lỗi";
            die();
        }

        // Đã có dữ liệu upload, thực hiện xử lý file upload

        //Thư mục bạn sẽ lưu file upload
        $target_dir = "../../img/products/";
        //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
        $target_file = $target_dir . basename($_FILES["HinhAnh"]["name"]);

        $allowUpload = true;

        //Lấy phần mở rộng của file (jpg, png, ...)
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Cỡ lớn nhất được upload (bytes)
        $maxfilesize = 800000;

        ////Những loại file được phép upload
        $allowtypes = array('jpg', 'png', 'jpeg', 'gif');


        if (isset($_POST["submit"])) {
            //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "Đây là file ảnh - " . $check["mime"] . ".";
                $allowUpload = true;
            } else {
                echo "Không phải file ảnh.";
                $allowUpload = false;
            }
        }

        // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
        // Bạn có thể phát triển code để lưu thành một tên file khác
        //            if (file_exists($target_file)) {
        //                echo "Tên file đã tồn tại trên server, không được ghi đè";
        //                $allowUpload = false;
        //            }
        // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
        if ($_FILES["HinhAnh"]["size"] > $maxfilesize) {
            echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
            $allowUpload = false;
        }


        // Kiểm tra kiểu file
        if (!in_array($imageFileType, $allowtypes)) {
            echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
            $allowUpload = false;
        }


        if ($allowUpload) {
            // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
            if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["HinhAnh"]["name"]) .
                    " Đã upload thành công.";

                echo "File lưu tại " . $target_file;

                $query = " update sanpham set MaLSP  = '" . $MaLSP . "', TenSP='" . $TenSP . "',
                                            DonGia='" . $DonGia . "',
                                            SoLuong='" . $SoLuong . "',
                                            MaKM='" . $MaKM . "',
                                            ManHinh='" . $ManHinh . "',
                                            HDH='" . $HDH . "',
                                            CamTruoc='" . $CamTruoc . "',
                                            CamSau='" . $CamSau . "',
                                            CPU='" . $CPU . "',
                                            Ram='" . $Ram . "',
                                            Rom='" . $Rom . "',
                                            SDCard='" . $SDCard . "',
                                            Pin='" . $Pin . "',
                                            SoSao='" . $SoSao . "',
                                            SoDanhGia='" . $SoDanhGia . "',
                                            HinhAnh='" . "img/products/".$image . "'
                                            where MaSP='" . $MaSP . "' ";
            } else {
                echo "Có lỗi xảy ra khi upload file.";
            }
        } else {
            echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
        }


    }else{
        $query = " update sanpham set       MaLSP  = '" . $MaLSP . "',
                                            TenSP='" . $TenSP . "',
                                            DonGia='" . $DonGia . "',
                                            SoLuong='" . $SoLuong . "',
                                            MaKM='" . $MaKM . "',
                                            ManHinh='" . $ManHinh . "',
                                            HDH='" . $HDH . "',
                                            CamTruoc='" . $CamTruoc . "',
                                            CamSau='" . $CamSau . "',
                                            CPU='" . $CPU . "',
                                            Ram='" . $Ram . "',
                                            Rom='" . $Rom . "',
                                            SDCard='" . $SDCard . "',
                                            Pin='" . $Pin . "',
                                            SoSao='" . $SoSao . "',
                                            SoDanhGia='" . $SoDanhGia . "'
                                            where MaSP='" . $MaSP . "' ";

    }
    $result = mysqli_query($conn, $query);
    if($result and $image!=null){
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],"../../img/products/".$_FILES["HinhAnh"]["tmp_name"]);
    }

}
function deleteproduct(){
    global $conn;
    $MaSP = $_GET['id'];
    mysqli_query($conn, "DELETE FROM chitiethoadon WHERE MaSP = $MaSP;");
    mysqli_query($conn, "DELETE FROM sanpham WHERE MaSP = $MaSP;");
    mysqli_query($conn, "DELETE FROM hoadon WHERE MaHD NOT IN (SELECT DISTINCT MaHD FROM chitiethoadon);");

}

