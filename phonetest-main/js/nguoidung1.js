var currentUser;
var tongTienTatCaDonHang = 0; // lưu tổng tiền từ tất cả các đơn hàng đã mua
var tongSanPhamTatCaDonHang = 0;

window.onload = function () {
    // thêm tags (từ khóa) vào khung tìm kiếm
    var tags = ["Samsung", "iPhone", "Huawei", "Oppo", "Mobi"];
    for (var t of tags) addTags(t, "index.php?search=" + t);

}

function checkTaiKhoan() {
    return new Promise(function(resolve, reject) {
        // Giả lập một yêu cầu AJAX
            var TaiKhoan=$('#TaiKhoan').val();
            console.log(TaiKhoan);
            var formData = new FormData();
            formData.append('TaiKhoan', TaiKhoan);
            $.ajax({
                type: "POST",
                url: 'php/ChangeInfo.php?action=checkTaiKhoan',
                data:formData,
                processData: false,
                contentType: false,
                success: function (json) {
                    var a=JSON.parse(json);
                    console.log(a);
                    if (a == "TaiKhoanDaTonTai") {
                        reject(); // Tài khoản đã tồn tại, từ chối Promise
                    } else {
                        resolve(); // Tài khoản không tồn tại, giải quyết Promise
                    }
                }
            });// Giả lập thời gian chờ của yêu cầu AJAX
    });
}
function checkEmail() {
    return new Promise(function(resolve, reject) {
            var Email=$('#Email').val();
            console.log(TaiKhoan);
            var formData = new FormData();
            formData.append('Email', Email);
            $.ajax({
                type: "POST",
                url: 'php/ChangeInfo.php?action=checkEmail',
                data:formData,
                processData: false,
                contentType: false,
                success: function (json) {
                    var a=JSON.parse(json);
                    // Giả sử kết quả từ yêu cầu AJAX là "TaiKhoanDaTonTai"
                    if (a === "EmailDaTonTai") {
                        reject(); // Tài khoản đã tồn tại, từ chối Promise
                    } else {
                        resolve(); // Tài khoản không tồn tại, giải quyết Promise
                    }
                }
            });
            // Giả lập thời gian chờ của yêu cầu AJAX
    });
}
function capNhat(inp){
    var infoValue=inp.value;
    var infoName=inp.name;
    var formData = new FormData();
    formData.append('infoValue', infoValue);
    formData.append('infoName', infoName);
    $.ajax({
        type: "POST",
        url: 'php/ChangeInfo.php?action=capNhat',
        data: formData,
        processData: false,
        contentType: false,
        success: function (json) {
            var a = JSON.parse(json);
            if (a === "EmailDaTonTai") {
                alert("Email đã có người sử dụng !!");
                return;
            }
        }
    });
}

function changeInfo(iTag, info) {
    var inp = iTag.parentElement.previousElementSibling.getElementsByTagName('input')[0];

    // Đang hiện
    if (!inp.readOnly && inp.value != '') {
        if (info == 'username') {
            checkTaiKhoan().then(function() {
                // Tiếp tục xử lý sau khi Tài khoản đã được kiểm tra
                console.log("Tài khoản hợp lệ");

                capNhat(inp);
            }).catch(function() {
                // Xử lý khi Tài khoản đã tồn tại
                alert("Tài khoản đã tồn tại");
                return;
            });
        } else if (info == 'email') {
            checkEmail().then(function() {
                // Tiếp tục xử lý sau khi Tài khoản đã được kiểm tra
                console.log("Email hợp lệ");
                capNhat(inp);
            }).catch(function() {
                // Xử lý khi Tài khoản đã tồn tại
                alert("Email đã tồn tại");
                return;
            });
        }else {
            capNhat(inp);
        }

        iTag.innerHTML = '';


    } else {
        iTag.innerHTML = ' Đồng ý';
        inp.focus();
        var v = inp.value;
        inp.value = '';
        inp.value = v;
    }

    inp.readOnly = !inp.readOnly;
}


function openChangePass() {
    var khungChangePass = document.getElementById('khungDoiMatKhau');
    var actived = khungChangePass.classList.contains('active');
    if (actived) khungChangePass.classList.remove('active');
    else khungChangePass.classList.add('active');
}
function changePass(){
    const old_password=$('#old_password').val();
    const new_password=$('#new_password').val();
    const rnew_password=$('#rnew_password').val();
    console.log(new_password);
    console.log(rnew_password);
    if (new_password!=rnew_password){
        alert('Mật khẩu mới nhập lại không đúng');
    }else {
        var formData = new FormData();
        formData.append('old_password', old_password);
        formData.append('new_password', new_password);
        $.ajax({
            type: "POST",
            url: 'php/ChangeInfo.php?action=changePwd',
            data: formData,
            processData: false,
            contentType: false,
            success: function (json) {
                var a = JSON.parse(json);
                if (a === "erro") {
                    alert("Mật khẩu cũ không đúng");
                    return;
                }else{
                    alert("Thay đổi mật khẩu thành công");
                    location.reload();
                    return;
                }
            }
        });
    }

}