
<?php
require_once ('php/connect.php');
global $conn;
$data = array();
$query = "SELECT lsp.TenLSP AS TenHang, SUM(hd.TongTien) AS DoanhThu
FROM loaisanpham lsp
JOIN sanpham sp ON lsp.MaLSP = sp.MaLSP
JOIN chitiethoadon cthd ON sp.MaSP = cthd.MaSP
JOIN hoadon hd ON cthd.MaHD = hd.MaHD
WHERE hd.TrangThai='1'
GROUP BY lsp.TenLSP";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
$data1 = array();
$query1 = "SELECT lsp.MaLSP, lsp.TenLSP, SUM(cthd.SoLuong) AS SoLuongDaBan
FROM chitiethoadon cthd
JOIN sanpham sp ON cthd.MaSP = sp.MaSP
JOIN loaisanpham lsp ON sp.MaLSP = lsp.MaLSP
JOIN hoadon ON cthd.MaHD = hoadon.MaHD
WHERE hoadon.TrangThai = 1 
GROUP BY lsp.MaLSP, lsp.TenLSP;";
$result = mysqli_query($conn, $query1);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data1[] = $row;
    }
}


?>


<div class="home" style="display: flex;     display: flex;
    align-items: center;
    justify-content: space-around;" >

    <div class="canvasContainer">
        <a>Doanh thu của từng hãng</a>
        <canvas id="myChart1"></canvas>
    </div>

    <div class="canvasContainer">
        <a>Số lượng bán của từng hãng</a>
        <canvas id="myChart2"></canvas>
    </div>
</div>
<script>
    $(document).ready(function () {
        show();
        show1();

    });
    // Generate unique colors for each dataset
    function adjustOpacity(hexColor, opacity) {
        var r = parseInt(hexColor.slice(1, 3), 16);
        var g = parseInt(hexColor.slice(3, 5), 16);
        var b = parseInt(hexColor.slice(5, 7), 16);
        return `rgba(${r}, ${g}, ${b}, ${opacity})`;
    }

    function show(){
        Chart.defaults.color = '#DDDDDD';
        var labels = [];
        var result = [];
        <?php foreach ($data as $row) { ?>
            labels.push("<?php echo $row['TenHang'] ?>");
            result.push(<?php echo $row['DoanhThu'] ?>);
                <?php } ?>
        var borderColorArray = generateRandomColors(result.length);
        var backgroundColorArray = borderColorArray;

        var pie = $("#myChart1");
        var myChart = new Chart(pie, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [
                    {
                        data: result,
                        borderColor: borderColorArray,
                        backgroundColor:backgroundColorArray.map(color => adjustOpacity(color, 0.4)),
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: "Doanh Thu"
                }
            }

        });
    };
        function show1(){
            var labels = [];
            var result = [];
            <?php foreach ($data1 as $row) { ?>
            labels.push("<?php echo $row['TenLSP'] ?>");
            result.push(<?php echo $row['SoLuongDaBan'] ?>);
            <?php } ?>
            var options = {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            var myChart = {
                labels: labels,
                datasets: [
                    {
                        label: 'Số lượng bán từng hãng',
                        backgroundColor: '#17cbd1',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#0ec2b6',
                        hoverBorderColor: '#42f5ef',
                        data: result
                    }
                ]
            };

            var bar = $("#myChart2");
            var barGraph = new Chart(bar, {
                type: 'bar',
                data: myChart,
                options: options
            });
        };
    // Function to generate an array of unique random colors
    function generateRandomColors(count) {
        var colors = [];
        var letters = '0123456789ABCDEF';

        for (var i = 0; i < count; i++) {
            var color = '#';
            for (var j = 0; j < 6; j++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors.push(color);
        }

        return colors;
    }
</script>
