const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

function add_NguoiDung(){
    var Ho=$('#Ho').val();
    var Ten=$('#Ten').val();
    var phone_number=$('#phone_number').val();
    var address=$('#address').val();
    var email=$('#email').val();
    var TaiKhoan=$('#TaiKhoan_DangKi').val();
    var password=$('#password_DangKi').val();
    var rpassword=$('#rpassword').val();
    if (!Ho){
        alert(" Vui lòng nhập họ của bạn")
    }else if (!Ten){
        alert(" Vui lòng nhập tên của bạn")
    } else if (!phone_number){
        alert(" Vui lòng nhập số điện thoại của bạn")
    } else if (!address){
        alert(" Vui lòng nhập địa chỉ của bạn")
    } else if (!email){
        alert(" Vui lòng nhập địa chỉ email của bạn")
    } else if (!TaiKhoan){
        alert(" Vui lòng nhập tài khoản của bạn")
    }else if (!password){
        alert(" Vui lòng nhập mật khẩu của bạn")
    } else if(password!=rpassword)
    { alert(" Mật khẩu nhập lại không đúng")
    }else{
        var check=1;
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            if (vnf_regex.test(phone_number) == false)
            {
                alert('Số điện thoại của bạn không đúng định dạng! Ví Dụ: 0xxxxxxxxx');
                check=0;
            }
        const regex_pattern =      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regex_pattern.test(email)) {
            alert('Email không hợp lệ ');
            check=0;
        }
            if (check==1) {
                // alert("ok");
                var formData = new FormData();
                formData.append('Ho', Ho);
                formData.append('Ten', Ten);
                formData.append('phone_number', phone_number);
                formData.append('address', address);
                formData.append('Email', email);
                formData.append('TaiKhoan', TaiKhoan);
                formData.append('MatKhau', password);
                $.ajax({
                    type: "POST",
                    url: './php/dangKiNguoiDung.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (json) {
                        console.log(JSON.parse(json))
                        var a = JSON.parse(json);
                        if (a === "TaiKhoanDaTonTai") {
                            alert("Tài khoản đã tồn tại")
                        } else {
                            alert("Đăng kí thành công")
                            window.location="login.php";
                        }


                    }
                });
            }
    }
}