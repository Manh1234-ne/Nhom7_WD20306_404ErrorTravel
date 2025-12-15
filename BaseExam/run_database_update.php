<?php
// Script để chạy update database

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Cập nhật Database - Liên kết Ghi chú đặc biệt</h1>";

try {
    require_once __DIR__ . '/configs/database.php';
    $conn = connectDB();
    
    echo "<h2>Bước 1: Thêm cột liên kết</h2>";
    
    // Kiểm tra xem cột đã tồn tại chưa
    $checkColumns = $conn->query("SHOW COLUMNS FROM yeu_cau_khach_dac_biet LIKE 'booking_id'");
    if ($checkColumns->rowCount() == 0) {
        $sql1 = "ALTER TABLE `yeu_cau_khach_dac_biet` 
                 ADD COLUMN `booking_id` INT NULL AFTER `id`,
                 ADD COLUMN `tour_id` INT NULL AFTER `booking_id`";
        $conn->exec($sql1);
        echo "✓ Đã thêm cột booking_id và tour_id<br>";
    } else {
        echo "✓ Cột booking_id và tour_id đã tồn tại<br>";
    }
    
    echo "<h2>Bước 2: Tạo view thông tin chi tiết</h2>";
    $sql2 = "CREATE OR REPLACE VIEW `v_yeu_cau_chi_tiet` AS
             SELECT 
                 y.id,
                 y.booking_id,
                 y.tour_id,
                 y.ten_khach,
                 y.loai_yeu_cau,
                 y.mo_ta,
                 y.trang_thai,
                 y.created_at,
                 y.updated_at,
                 t.ten_tour,
                 d.so_dien_thoai,
                 d.email,
                 d.ngay_khoi_hanh
             FROM yeu_cau_khach_dac_biet y
             LEFT JOIN tour t ON y.tour_id = t.id
             LEFT JOIN dat_tour d ON y.booking_id = d.id";
    
    $conn->exec($sql2);
    echo "✓ Đã tạo view v_yeu_cau_chi_tiet<br>";
    
    echo "<h2>Bước 3: Kiểm tra dữ liệu</h2>";
    $stmt = $conn->query("SELECT COUNT(*) as total FROM yeu_cau_khach_dac_biet");
    $total = $stmt->fetch()['total'];
    echo "Tổng số yêu cầu: $total<br>";
    
    $stmt2 = $conn->query("SELECT COUNT(*) as total FROM dat_tour");
    $totalBookings = $stmt2->fetch()['total'];
    echo "Tổng số booking: $totalBookings<br>";
    
    $stmt3 = $conn->query("SELECT COUNT(*) as total FROM tour");
    $totalTours = $stmt3->fetch()['total'];
    echo "Tổng số tour: $totalTours<br>";
    
    echo "<h2>✅ Cập nhật database thành công!</h2>";
    echo "<p><strong>Các tính năng mới:</strong></p>";
    echo "<ul>";
    echo "<li>Liên kết yêu cầu đặc biệt với booking tour</li>";
    echo "<li>Hiển thị thông tin tour trong danh sách yêu cầu</li>";
    echo "<li>Tạo yêu cầu từ booking có sẵn</li>";
    echo "<li>Theo dõi yêu cầu theo từng tour</li>";
    echo "</ul>";
    
    echo "<p><a href='index.php?action=yeu_cau'>Xem danh sách yêu cầu</a></p>";
    echo "<p><a href='index.php?action=yeu_cau_create'>Tạo yêu cầu mới</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Lỗi:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>