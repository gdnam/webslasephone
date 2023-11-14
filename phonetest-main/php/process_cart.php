<?php
//session_start();
include 'connect.php';
//$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "update":
        $result = update_cart();
        break;
    case "tangsoluong":
        $result = tangsoluong();;
        break;
    case "giamsoluong":
        $result = giamsoluong();
        break;
    default:
        break;
}
function update_cart($add = false)
{
    $changeQuantity = false;
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            if ($id >= 0) {
                array_splice($_SESSION['giohang'],$id, 1);
            }
        } else {
            if (!isset($_SESSION["cart"][$id][3])) {
                $_SESSION["giohang"][$id][3] = 0;
            }
            if ($add) {
                $_SESSION["giohang"][$id][3] += $quantity;
            } else {
                $_SESSION["giohang"][$id][3] = $quantity;
            }
            //Kiểm tra số lượng sản phẩm tồn kho
//            $addProduct = mysqli_query($GLOBALS['connection'], "SELECT `SoLuong` FROM `sanpham` WHERE `id` = " . $id);
//            $addProduct = mysqli_fetch_assoc($addProduct);
//            if ($_SESSION["giohang"][$id] > $addProduct['quantity']) {
//                $_SESSION["giohang"][$id] = $addProduct['quantity'];
//                if ($add) {
//                    return array(
//                        'status' => 0,
//                        'message' => "Số lượng sản phẩm tồn kho chỉ còn: " . $addProduct['quantity'] . " sản phẩm. Bạn vui lòng kiểm tra lại giỏ hàng."
//                    );
//                } else {
//                    $changeQuantity = true;
//                }
//            }
//            if ($add) {
//                return array(
//                    'status' => 1,
//                    'message' => "Thêm sản phẩm thành công"
//                );
//            }
        }
    }
}

function tangsoluong(){
        global $conn;
        $id=$_GET['id'];
        $MaSP=$_GET['MaSP'];
        $sql="SELECT `SoLuong` FROM `sanpham` WHERE `MaSP` ='$MaSP'"  ;
        $addProduct = mysqli_query($conn, $sql);
        $addProduct = mysqli_fetch_array($addProduct);
        if ($_SESSION["giohang"][$id][3]+1 > $addProduct['SoLuong']) {
            $error = "LoiSoLuong";
            echo json_encode ($error);
        }else {
            $error = "ok";
            echo json_encode ($error);
            $_SESSION['giohang'][$id][3] = $_SESSION['giohang'][$id][3] + 1;
        }

}
function giamsoluong(){
        if ($_SESSION['giohang'][$_GET['id']][3] == 1) {
            if (isset($_GET['id'] ) && ($_GET['id'] >= 0)) {
                array_splice($_SESSION['giohang'], $_GET['id'], 1);
            }
        } else {
            $_SESSION['giohang'][$_GET['id']][3] = $_SESSION['giohang'][$_GET['id']][3] - 1;
        };
}