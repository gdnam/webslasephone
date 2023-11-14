<?php
require_once ('connect.php');

switch ($_GET['action']) {
    case "checkTaiKhoan":
        $result = checkTaiKhoan();
        break;
    case "checkEmail":
        $result = checkEmail();
        break;
    case "capNhat":
        $result = capNhat();
        break;

    case "changePwd":
        $result = changePwd();
        break;
    default:
        break;
}
function checkTaiKhoan(){
    global $conn;
    $TaiKhoan=$_POST['TaiKhoan'];
    $sql_tk="select * from nguoidung where TaiKhoan='$TaiKhoan'";
    $result =mysqli_fetch_array(mysqli_query($conn,$sql_tk));
    if ($result){
        $error = "TaiKhoanDaTonTai";
        echo json_encode ($error);
    }else{
        $error = "ok";
        echo json_encode ($error);
    }
}
function checkEmail(){
    global $conn;
    $Email=$_POST['Email'];
    $sql_e="select * from nguoidung where Email='$Email'";
    $result =mysqli_fetch_array(mysqli_query($conn,$sql_e));
    if ($result){
        $error = "EmailDaTonTai";
        echo json_encode ($error);
    }else{
        $error = "ok";
        echo json_encode ($error);
    }
}

function capNhat(){
    global $conn;
    $infoName=$_POST['infoName'];
    $infoValue=$_POST['infoValue'];
    $sql_i="UPDATE nguoidung
            SET $infoName='$infoValue'
            WHERE MaND='".$_SESSION['user']['MaND']."'";
    $result =mysqli_query($conn,$sql_i);
    if ($result){
        $error = "ok";
        echo json_encode ($error);
        $sql_acc="select * from nguoidung where MaND='".$_SESSION['user']['MaND']."'";
        $_SESSION['user']= mysqli_fetch_array(mysqli_query($conn,$sql_acc));

    }else{
        $error = "erro";
        echo json_encode ($error);

    }

}
function changePwd(){
    global $conn;
    $old_password=$_POST['old_password'];
    $pwd=md5($old_password);
    $new_password=$_POST['new_password'];
    $pwd_new=md5($new_password);
    $sql_check="select * from nguoidung where MatKhau='$pwd' and TaiKhoan='".$_SESSION['user']['TaiKhoan']."'  ";
    $result_check = mysqli_fetch_array(mysqli_query($conn,$sql_check));
    if (!$result_check){
        $error = "erro";
        echo json_encode ($error);
    }else{
        $sql_i="UPDATE nguoidung
            SET MatKhau='$pwd_new'
            WHERE MaND='".$_SESSION['user']['MaND']."'";
        mysqli_query($conn,$sql_i);
        $error = "ok";
        echo json_encode ($error);
    }
}