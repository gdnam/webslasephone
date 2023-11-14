window.onload = function () {
    // thêm  banner vào html
    function addBanner(img, link) {
        var newDiv = `<div class='item'>
						<a target='_blank' href=` + link + `>
							<img src=` + img + `>
						</a>
					</div>`;
        var banner = document.getElementsByClassName('owl-carousel')[0];
        banner.innerHTML += newDiv;
    }
    // Thêm hình vào banner
    addBanner("img/banners/banner0.gif", "img/banners/banner0.gif");
    var numBanner = 4; // Số lượng hình banner
    for (var i = 1; i <= numBanner; i++) {
        var linkimg = "img/banners/banner" + i + ".jpg";
        addBanner(linkimg, linkimg);
    }
    // Khởi động thư viện hỗ trợ banner - chỉ chạy khi đã tạo hình trong banner
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1.5,
        margin: 100,
        center: true,
        loop: true,
        smartSpeed: 450,
        autoplay: true,
        autoplayTimeout: 3500
    });


    // thêm tags (từ khóa) vào khung tìm kiếm
    var tags = ["Samsung", "iPhone", "Huawei", "Oppo", "Mobi"];
    for (var t of tags) addTags(t, "index.php?search=" + t);

    // Thêm danh sách hãng điện thoại
    function addCompany(img, nameCompany) {
        var new_tag = `<a href=index.php?searchCompany=` + nameCompany + `><img src=` + img + `></a>`;
        var khung_hangSanXuat = document.getElementsByClassName('companyMenu')[0];
        khung_hangSanXuat.innerHTML += new_tag;
    }

    var company = ["Apple.jpg", "Samsung.jpg", "Oppo.jpg", "Nokia.jpg", "Huawei.jpg", "Xiaomi.png",
        "Realme.png", "Vivo.jpg", "Philips.jpg", "Mobell.jpg", "Mobiistar.jpg", "Itel.jpg",
        "Coolpad.png", "HTC.jpg", "Motorola.jpg"
    ];
    for (var c of company) addCompany("img/company/" + c, c.slice(0, c.length - 4));
    // slider chọn khoảng giá
    $("#demoSlider").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 50,
        from: 0,
        to: 50,
        step: 0.5,
        drag_interval: true,
        postfix: " triệu",
        prettify_enabled: true,
        prettify_separator: ",",
        values_separator: " →   ",
        onFinish: function(data) {
            var url=window.location.href;
            var urlObj = new URL(url);
            var searchString = urlObj.search;
            console.log(searchString);
            if (searchString.includes("min") && searchString.includes("max")) {
                var searchStringWithoutQuestionMark ='';
            }else {
                var searchStringWithoutQuestionMark = searchString.substring(1);
                console.log(searchStringWithoutQuestionMark);
            }
                $.ajax({
                type: "POST",
                url: `KhungSanPham.php?min=`+data.from * 1E6+`&max=`+data.to * 1E6+`&`+searchStringWithoutQuestionMark,
                success: function () {
                    $.get(`KhungSanPham.php?min=`+data.from * 1E6+`&max=`+data.to * 1E6+`&`+searchStringWithoutQuestionMark, function (cartContentHTML) {
                        console.log(cartContentHTML);
                        $('#contain-khungSanPham').html(cartContentHTML);
                    });
                }
            });
            // window.location=`KhungSanPham.php?min=`+data.from * 1E6+`&max=`+data.to * 1E6;
            // console.log(data.from * 1E6 + "-" + data.to * 1E6);

        },
    });
    // Chuyển mức giá về dạng chuỗi tiếng việt
    function priceToString(min, max) {
        if (min == 0) return 'Dưới ' + max / 1E6 + ' triệu';
        if (max == 0) return 'Trên ' + min / 1E6 + ' triệu';
        return 'Từ ' + min / 1E6 + ' - ' + max / 1E6 + ' triệu';
    }

// Chuyển số sao về dạng chuỗi tiếng việt
    function starToString(star) {
        return 'Trên ' + (star - 1) + ' sao';
    }

// Chuyển các loại sắp xếp về dạng chuỗi tiếng việt
    function sortToString(sortBy) {
        switch (sortBy) {
            case 'price':
                return 'Giá ';
            case 'star':
                return 'Sao ';
            case 'rateCount':
                return 'Đánh giá ';
            case 'name':
                return 'Tên ';
            default:
                return '';
        }
    }


    // Thêm chọn mức giá
    function addPricesRange(min, max) {
        var text = priceToString(min, max);
        var a = `<a onclick="loctheogia('` + min + `', '` + max + `')">` + text + `</a>`

        document.getElementsByClassName('pricesRangeFilter')[0]
            .getElementsByClassName('dropdown-content')[0].innerHTML += a;
    }

// Thêm chọn số lượng sao
    function addStarFilter(value) {
        var text = starToString(value);
        var star = `<a onclick=" ">` + text + `</a>`;

        document.getElementsByClassName('starFilter')[0]
            .getElementsByClassName('dropdown-content')[0].innerHTML += star;
    }

// Thêm chọn sắp xếp theo giá
    function addSortFilter(type, nameFilter, text) {
        // var sortTag = `<a onclick="xapSep(type ,nameFilter)">` + text + `</a>`;
        var sortTag = `<a onclick="xapSep('` + type + `', '` + nameFilter + `')">` + text + `</a>`;
        document.getElementsByClassName('sortFilter')[0]
            .getElementsByClassName('dropdown-content')[0].innerHTML += sortTag;
    }

    // Thêm chọn mức giá
    addPricesRange(0, 2000000);
    addPricesRange(2000000, 4000000);
    addPricesRange(4000000, 7000000);
    addPricesRange(7000000, 13000000);
    addPricesRange(13000000, 0);
    // Thêm chọn sắp xếp
    addSortFilter('asc', 'DonGia', 'Giá tăng dần');
    addSortFilter('desc', 'DonGia', 'Giá giảm dần');
    addSortFilter('asc', 'TenSP', 'Tên A-Z');
    addSortFilter('desc', 'TenSP', 'Tên Z-A');


}
function xapSep(type,nameFilter){
    var str=window.location.href;
    if (str.includes('type') && str.includes('nameFilter')) {
            updatedUrl = str.replace(/type=([^&]*)/, 'type='+type).replace(/nameFilter=([^&]*)/, 'nameFilter='+nameFilter);
            window.location=updatedUrl;

    }else {
        var hasQuestionMark = str.includes('?');
        if (hasQuestionMark) {
            console.log("Chuỗi có chứa ký tự ?");
            window.location = window.location.href + `&type=` + type + `&nameFilter=` + nameFilter;
        } else {
            console.log("Chuỗi không chứa ký tự ?");
            window.location = window.location.href + `?type=` + type + `&nameFilter=` + nameFilter;
        }
    }


}
function loctheogia(min,max){
    var url=window.location.href;
    var urlObj = new URL(url);
    var searchString = urlObj.search;
    console.log(searchString);
    if (searchString.includes("min") && searchString.includes("max")) {
        var searchStringWithoutQuestionMark ='';
    }else {
        var searchStringWithoutQuestionMark = searchString.substring(1);
        console.log(searchStringWithoutQuestionMark);
    }
    $.ajax({
        type: "POST",
        url: `KhungSanPham.php?min=`+min+`&max=`+max+`&`+searchStringWithoutQuestionMark,
        success: function () {
            $.get(`KhungSanPham.php?min=`+min+`&max=`+max+`&`+searchStringWithoutQuestionMark, function (cartContentHTML) {
                console.log(cartContentHTML);
                $('#contain-khungSanPham').html(cartContentHTML);
            });
        }
    });

}
function xemThemSP(limit){
    // alert('asdsadsa');
    $.ajax({
        type: "POST",
        url: `KhungSanPham.php?`+limit,
        success: function () {
            $.get(`KhungSanPham.php?`+limit, function (cartContentHTML) {
                // console.log(cartContentHTML);
                $('#contain-khungSanPham').html(cartContentHTML);
            });
        }
    });
}