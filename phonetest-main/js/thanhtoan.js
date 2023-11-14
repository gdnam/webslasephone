function getDiaChi(){
    var Ho=$('#Ho').val();
    var Ten=$('#Ten').val();
    var phone_number=$('#phone_number').val();
    // var city=$('#city').val();
    // var district=$('#district').val();
    // var ward=$('#ward').val();
    var specific_address=$('#specific_address').val();
    var city = citis.options[citis.selectedIndex].text;
    var district = districts.options[districts.selectedIndex].text;
    var ward = wards.options[wards.selectedIndex].text;
    var formData = new FormData();
    formData.append('Ho', Ho);
    formData.append('Ten', Ten);
    formData.append('phone_number', phone_number);
    formData.append('city', city);
    formData.append('district', district)
    formData.append('ward', ward);
    formData.append('specific_address', specific_address);
    $.ajax({
        type: "POST",
        url: './php/Process_ThanhToan.php?action=getSessionDiaChi',
        data:formData,
        processData: false,
        contentType: false,
        success: function () {
            window.location="thanhtoan.php";
        }
    });
}
function add_DonHang(){

    $.ajax({
        type: "POST",
        url: './php/Process_ThanhToan.php?action=addGioHangSQL',
        success: function () {
            alert("bạn đã đặt hành thành công")
            window.location="index.php";
        }
    });
}