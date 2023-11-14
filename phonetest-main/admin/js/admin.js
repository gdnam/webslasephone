function getsanpham(){
    $.get('sanpham.php', function (cartContentHTML) {
         
        $('#main-content').html(cartContentHTML);
    });
}
function getdonhang(){
    $.get('donhang.php', function (cartContentHTML) {
         
        $('#main-content').html(cartContentHTML);
    });
}
function getkhachhang(){
    $.get('khachhang.php', function (cartContentHTML) {
         
        $('#main-content').html(cartContentHTML);
    });
}
function gethome(){
    $.get('home.php', function (cartContentHTML) {
         
        $('#main-content').html(cartContentHTML);
    });
}
function viewProduct(id){
            $.get('./add_update_product.php?updateProduct='+id, function (cartContentHTML) {
                $('#khungThemSanPham').html(cartContentHTML);
                document.getElementById('khungThemSanPham').style.transform = 'scale(1)';
    });
}
function viewAddProduct(){
            $.get('./add_update_product.php', function (cartContentHTML) {
                $('#khungThemSanPham').html(cartContentHTML);
                document.getElementById('khungThemSanPham').style.transform = 'scale(1)';
    });
}

function addProduct(){
    // console.log('sdasddsa');
    var MaSP=$('#MaSP').val();
    var MaLSP=$('#MaLSP').val();
    var TenSP=$('#TenSP').val();
    var DonGia=$('#DonGia').val();
    var SoLuong=$('#SoLuong').val();

    var fileInput = document.getElementById('HinhAnh');
    var file = fileInput.files[0];

    if (!file) {
        alert('Please select a file.');
        return;
    }

    var MaKM=$('#MaKM').val();
    var SoLuong=$('#SoLuong').val();
    var ManHinh=$('#ManHinh').val();
    var HDH=$('#HDH').val();
    var CamSau=$('#CamSau').val();
    var CamTruoc=$('#CamTruoc').val();
    var CPU=$('#CPU').val();
    var Ram=$('#Ram').val();
    var Rom=$('#Rom').val();
    var SDCard=$('#SDCard').val();
    var Pin=$('#Pin').val();
    var SoSao=$('#SoSao').val();
    var SoDanhGia=$('#SoDanhGia').val();
    var formData = new FormData();
    formData.append('MaLSP', MaLSP);
    formData.append('SoLuong', SoLuong);
    formData.append('TenSP', TenSP);
    formData.append('DonGia', DonGia);
    formData.append('HinhAnh', file);
    formData.append('MaKM', MaKM);
    formData.append('ManHinh', ManHinh);
    formData.append('HDH', HDH);
    formData.append('CamSau', CamSau);
    formData.append('CamTruoc', CamTruoc);
    formData.append('CPU', CPU);
    formData.append('Ram', Ram);
    formData.append('Rom', Rom);
    formData.append('SDCard', SDCard);
    formData.append('Pin', Pin);
    formData.append('SoSao', SoSao);
    formData.append('SoDanhGia', SoDanhGia);

    $.ajax({
        method: "POST",
        url: './php/process_product.php?action=addproduct',
        data:formData,
        processData: false,
        contentType: false,
        success: function () {
            document.getElementById('khungThemSanPham').style.transform = 'scale(0)';
            $.get('sanpham.php', function (cartContentHTML) {
                $('#main-content').html(cartContentHTML);
            });

        }
    });
    // console.log('dsasdadsasda')
}
function updateProduct(){
    var MaSP=$('#MaSP').val();
    var MaLSP=$('#MaLSP').val();
    var TenSP=$('#TenSP').val();
    var DonGia=$('#DonGia').val();
    var SoLuong=$('#SoLuong').val();

    var fileInput = document.getElementById('HinhAnh');
    var file = fileInput.files[0];
    if (!file) {
        file=null;
    }
    var MaKM=$('#MaKM').val();
    var SoLuong=$('#SoLuong').val();
    var ManHinh=$('#ManHinh').val();
    var HDH=$('#HDH').val();
    var CamSau=$('#CamSau').val();
    var CamTruoc=$('#CamTruoc').val();
    var CPU=$('#CPU').val();
    var Ram=$('#Ram').val();
    var Rom=$('#Rom').val();
    var SDCard=$('#SDCard').val();
    var Pin=$('#Pin').val();
    var SoSao=$('#SoSao').val();
    var SoDanhGia=$('#SoDanhGia').val();
    var formData = new FormData();
    formData.append('MaSP', MaSP);
    formData.append('MaLSP', MaLSP);
    formData.append('SoLuong', SoLuong);
    formData.append('TenSP', TenSP);
    formData.append('DonGia', DonGia);
    formData.append('HinhAnh', file);
    formData.append('MaKM', MaKM);
    formData.append('ManHinh', ManHinh);
    formData.append('HDH', HDH);
    formData.append('CamSau', CamSau);
    formData.append('CamTruoc', CamTruoc);
    formData.append('CPU', CPU);
    formData.append('Ram', Ram);
    formData.append('Rom', Rom);
    formData.append('SDCard', SDCard);
    formData.append('Pin', Pin);
    formData.append('SoSao', SoSao);
    formData.append('SoDanhGia', SoDanhGia);

    $.ajax({
        method: "POST",
        url: './php/process_product.php?action=updateProduct',
        data:formData,
        processData: false,
        contentType: false,
        success: function () {
            document.getElementById('khungThemSanPham').style.transform = 'scale(0)';
            const kieutimkiem=$("#kieuTimSanPham").val();
            const noidungtimkiem=$("#TimKiemSanPham").val();
            if (kieutimkiem&&noidungtimkiem){
                $.get('php/process_TimKiem.php?action=sanPham&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                    $('#table-content').html(cartContentHTML);
                });
            }else {
                $.get('sanpham.php', function (cartContentHTML) {
                    $('#table-content').load('sanpham.php #table-content');
                });
            }

        }
    });
}
function deleteProduct(id){
    let text = "bạn có chắc muốn xoá điện thoại này ?";
    if (confirm(text) == true) {
        $.ajax({
            method: "POST",
            url: './php/process_product.php?action=deleteproduct&id='+id,
            success: function () {
                const kieutimkiem=$("#kieuTimSanPham").val();
                const noidungtimkiem=$("#TimKiemSanPham").val();
                if (kieutimkiem&&noidungtimkiem){
                    $.get('php/process_TimKiem.php?action=sanPham&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                        $('#table-content').html(cartContentHTML);
                    });
                }else {
                    $.get('sanpham.php', function (cartContentHTML) {
                        $('#table-content').load('sanpham.php #table-content');
                    });
                }
            }
        });
    } else {
    }

}
function duyetDonHang(id){
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();
    const kieutimkiem=$("#kieuTimDonHang").val();
    const noidungtimkiem=$("#NoiDungDonHangTimKiem").val();
    console.log(id);
    $.ajax({
        method: "POST",
        url: './php/process_DonHang.php?action=xacNhan&id='+id,
        success: function () {
            $.get('php/process_TimKiem.php?action=donHang&tungay='+fromDate+'&denngay='+toDate+'&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });
        }
    });
}
function choXuLy(id){
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();
    const kieutimkiem=$("#kieuTimDonHang").val();
    const noidungtimkiem=$("#NoiDungDonHangTimKiem").val();
    console.log(id);
    $.ajax({
        method: "POST",
        url: './php/process_DonHang.php?action=choXuLy&id='+id,
        success: function () {
            $.get('php/process_TimKiem.php?action=donHang&tungay='+fromDate+'&denngay='+toDate+'&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });
        }
    });
}
function huy(id){
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();
    const kieutimkiem=$("#kieuTimDonHang").val();
    const noidungtimkiem=$("#NoiDungDonHangTimKiem").val();
    console.log(id);
    $.ajax({
        method: "POST",
        url: './php/process_DonHang.php?action=huy&id='+id,
        success: function () {
            $.get('php/process_TimKiem.php?action=donHang&tungay='+fromDate+'&denngay='+toDate+'&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });
        }
    });
}
function doiTrangThaiND(id){
    console.log(id);
    $.ajax({
        method: "POST",
        url: './php/process_KhachHang.php?action=doiTrangThaiND&id='+id,
        success: function () {
            const kieutimkiem=$("#kieuTimNguoiDung").val();
            const noidungtimkiem=$("#NoiDungNguoiDungTimKiem").val();
            $.get('php/process_TimKiem.php?action=nguoiDung&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });
        }
    });
}
function timKiemSanPham(input){
    const kieutimkiem=$("#kieuTimSanPham").val();
    const noidungtimkiem=input.value;
            $.get('php/process_TimKiem.php?action=sanPham&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });

}
function timKiemDonHang(input){
    const kieutimkiem=$("#kieuTimDonHang").val();
    const noidungtimkiem=input.value;
            $.get('php/process_TimKiem.php?action=donHang&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                $('#table-content').html(cartContentHTML);
            });
}
function locDonHangTheoNgay(){
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();
    const kieutimkiem=$("#kieuTimDonHang").val();
    const noidungtimkiem=$("#NoiDungDonHangTimKiem").val();
    console.log(noidungtimkiem);
    console.log(kieutimkiem);
    console.log(fromDate);
    console.log(toDate);
    $.get('php/process_TimKiem.php?action=donHang&tungay='+fromDate+'&denngay='+toDate+'&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
        $('#table-content').html(cartContentHTML);
    });

}
function viewAddNguoiDung(){
    $.get('./add_update_nguoidung.php', function (cartContentHTML) {
        $('#khungThemSanPham').html(cartContentHTML);
        document.getElementById('khungThemSanPham').style.transform = 'scale(1)';
    });
}
function addNguoiDung(){
    var Ho=$('#HoND').val();
    var Ten=$('#TenND').val();
    var phone_number=$('#Phonenumber').val();
    var address=$('#Address').val();
    var email=$('#Email').val();
    var TaiKhoan=$('#TaiKhoan').val();
    var password=$('#password').val();
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
                url: '../php/dangKiNguoiDung.php',
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
                        document.getElementById('khungThemSanPham').style.transform = 'scale(0)';
                        $.get('khachhang.php', function (cartContentHTML) {
                            $('#main-content').html(cartContentHTML);
                        });
                    }


                }
            });
        }
    }
}
function timKiemNguoiDung(){
    const kieutimkiem=$("#kieuTimNguoiDung").val();
    const noidungtimkiem=$("#NoiDungNguoiDungTimKiem").val();
    console.log(kieutimkiem);
    console.log(noidungtimkiem);
    $.get('php/process_TimKiem.php?action=nguoiDung&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
        $('#table-content').html(cartContentHTML);
    });


}
function xoaNguoiDung(id){
    let text = "bạn có chắc muốn xoá người dùng này ?";
    if (confirm(text) == true) {
        $.ajax({
            method: "POST",
            url: './php/process_KhachHang.php?action=deleteND&id='+id,
            success: function () {
                const kieutimkiem=$("#kieuTimNguoiDung").val();
                const noidungtimkiem=$("#NoiDungNguoiDungTimKiem").val();
                $.get('php/process_TimKiem.php?action=nguoiDung&kieutimkiem='+kieutimkiem+'&noidungtimkiem='+noidungtimkiem, function (cartContentHTML) {
                    $('#table-content').html(cartContentHTML);
                });
            }
        });
    } else {
    }

}


