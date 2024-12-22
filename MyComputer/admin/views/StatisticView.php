<?php 
$this->layoutPath = "Layout.php";
?>
<div class="wrap">

    <div style="margin-bottom: 20px;" class="col-md-12">
        
        <h1>Thống kê</h1>
        <div class="wrap_statistic">
            <div class="block">
                <h2>Người dùng</h2>
                <p>Tổng số: <?php echo $data['customer']; ?></p>
            </div>
            <div class="block">
                <h2>Sản phẩm</h2>
                <p>Tổng số: <?php echo $data['product']; ?></p>
            </div>
            <div class="block">
                <h2>Đơn hàng</h2>
                <p>Tổng số: <?php echo $data['order']; ?></p>
            </div>
            <div class="block">
                <h2>Danh mục</h2>
                <p>Tổng số: <?php echo $data['category']; ?></p>
            </div>
            <div class="block">
                <h2>Lợi nhuận</h2>
                <p>Tổng số dự kiếm: <?php echo number_format($data['profit'], 2); ?> VNĐ</p>
                <p style="transform: translateY(-10px);">Lợi nhuận thực tế: <?php echo number_format($data['profit1'], 2); ?> VNĐ</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
         <h1>Biểu đồ thu nhập tổng quan </h1>
            <?php
            // Kết nối cơ sở dữ liệu
            $conn = Connection::getInstance();

            // Chọn chế độ xem (ngày, tháng)
            $mode = $_GET['mode'] ?? 'day';

            switch ($mode) {
                case 'day':
                    $query1 = "SELECT DATE(o.create_at) AS label, SUM(od.number * od.price) AS value 
                               FROM orders o
                               JOIN orderdetails od ON o.id = od.order_id
                                WHERE o.status = 1 AND o.create_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                               GROUP BY DATE(o.create_at)
                               ORDER BY DATE(o.create_at) LIMIT 7";
                    break;
                case 'week':
                   $query1 = "SELECT CONCAT(YEAR(o.create_at), '-W', WEEK(o.create_at, 1)) AS label, 
                           SUM(od.number * od.price) AS value 
                   FROM orders o
                   JOIN orderdetails od ON o.id = od.order_id
                   WHERE o.status = 1 AND YEARWEEK(o.create_at, 1) >= YEARWEEK(CURDATE(), 1) - 6
                   GROUP BY YEAR(o.create_at), WEEK(o.create_at, 1)
                   ORDER BY YEAR(o.create_at), WEEK(o.create_at, 1)";

                    break;

                case 'month':
                    $query1 = "SELECT MONTH(o.create_at) AS month, SUM(od.number * od.price) AS value 
                               FROM orders o
                               JOIN orderdetails od ON o.id = od.order_id
                               WHERE o.status = 1 AND YEAR(o.create_at) = YEAR(CURDATE())
                               GROUP BY MONTH(o.create_at)
                               ORDER BY MONTH(o.create_at)";
                    break;
            }

            $data1 = $conn->query($query1)->fetchAll(PDO::FETCH_ASSOC);

            // Tạo danh sách 12 tháng mặc định
            $months = [];
            $values = array_fill(0, 12, 0); // Mặc định giá trị là 0
            for ($i = 1; $i <= 12; $i++) {
                $months[] = date('Y M', strtotime("2024-$i-01")); // Thay "2023" bằng năm bạn muốn
            }

            // Chuẩn bị dữ liệu cho chế độ "month"
            if ($mode === 'month') {
                foreach ($data1 as $row) {
                    $monthIndex = $row['month'] - 1; // Lấy chỉ số tháng (0-11)
                    $values[$monthIndex] = (float)$row['value']; // Gán giá trị vào tháng tương ứng
                }
            } else {
                // Chế độ "day": sử dụng dữ liệu từ query
                $labels = [];
                $values = [];
                foreach ($data1 as $row) {
                    $labels[] = $row['label'];
                    $values[] = $row['value'];
                }
                $months = $labels; // Sử dụng nhãn là ngày
            }

            // JSON hóa dữ liệu để truyền vào JavaScript
            $labels_json = json_encode($months);
            $values_json = json_encode($values);
            ?>

            <div>
                <button onclick="changeMode('day')">Theo ngày</button>
                <button onclick="changeMode('week')">Theo Tuần</button>
                <button onclick="changeMode('month')">Theo tháng</button>
            </div>
            <canvas id="profitChart" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                let chart;

                // Hàm vẽ biểu đồ
                function drawChart(labels, values) {
                    const ctx = document.getElementById('profitChart').getContext('2d');
                    if (chart) chart.destroy(); // Hủy biểu đồ cũ nếu có
                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Tổng lợi nhuận',
                                data: values,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                // Dữ liệu ban đầu
                drawChart(<?php echo $labels_json; ?>, <?php echo $values_json; ?>);

                // Đổi chế độ xem
                function changeMode(mode) {
                    window.location.href = "?controller=statistic&mode=" + mode;
                }
            </script>

    </div>
</div>

<style>
.wrap_statistic {
    display: flex;

  height: 120px;
  flex-direction: row;
  justify-content: space-evenly;
}
.block {
    border: 1px solid #ccc;
    padding: 10px 60px;
    box-shadow: 3px 3px 3px #ccc;
}
</style>

