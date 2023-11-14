
function updatequantity(quantity){
    if (quantity != "") {
        $.ajax({
            type: "POST",
            url: './php/process_cart.php?action=update',
            data: $('#cart-form').serializeArray(),
            success: function () {
                    $.get('./card-form.php', function (cartContentHTML) {
                        // console.log(cartContentHTML);
                        $('#cart-form').html(cartContentHTML);
                    });
            }
        });
    }
}

function tangSoLuong(id,MaSP) {
        $.ajax({
            type: "POST",
            url: './php/process_cart.php?action=tangsoluong&id='+id+'&MaSP='+MaSP,
            success: function (json) {
                console.log(JSON.parse(json))
                var a = JSON.parse(json);
                if (a === "LoiSoLuong") {
                    alert("Số lượng trong kho hàng không đủ")
                } else {
                    $.get('./card-form.php', function (cartContentHTML) {
                        $('#cart-form').html(cartContentHTML);
                    });
                }

            }
        });
    // console.log('aadsasds')

}

function giamsoluong(id) {
    $.ajax({
        type: "POST",
        url: './php/process_cart.php?action=giamsoluong&id='+id,
        success: function () {
            $.get('./card-form.php', function (cartContentHTML) {
                // console.log(cartContentHTML);
                $('#cart-form').html(cartContentHTML);
            });
        }
    });

}