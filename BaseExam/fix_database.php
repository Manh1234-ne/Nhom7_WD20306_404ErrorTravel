<?php
// Script sửa lỗi database đơn giản

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Sửa lỗi Database</h1>";

try {
    require_once __DIR__ . '/configs/database.php';
    $conn = connectDB();
    
    echo "<h2>Bước 1: Kiểm tra cột hiện tại</h2>";
    $result = $conn->query("SHOW COLUMNS FROM yeu_cau_khach_dac_biet");
    $columns = $result->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Các cột hiện tại:<br>";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
    }
    
    // Kiểm tra xem cột booking_id có tồn tại không
    $hasBookingId = false;
    $hasTourId = false;
    foreach ($columns as $col) {
        if ($col['Field'] == 'booking_id') $hasBookingId = true;
        if ($col['Field'] == 'tour_id') $hasTourId = true;
    }
    
    echo "<h2>Bước 2: Thêm cột nếu chưa có</h2>";
    
    if (!$hasBookingId) {
        $conn->exec("ALTER TABLE yeu_cau_khach_dac_biet ADD COLUMN booking_id INT NULL AFTER id");
        echo "✓ Đã thêm cột booking_id<br>";
    } else {
        echo "✓ Cột booking_id đã tồn tại<br>";
    }
    
    if (!$hasTourId) {
        $conn->exec("ALTER TABLE yeu_cau_khach_dac_biet ADD COLUMN tour_id INT NULL AFTER booking_id");
        echo "✓ Đã thêm cột tour_id<br>";
    } else {
        echo "✓ Cột tour_id đã tồn tại<br>";
    }
    
    echo "<h2>Bước 3: Kiểm tra lại cấu trúc</h2>";
    $result2 = $conn->query("SHOW COLUMNS FROM yeu_cau_khach_dac_biet");
    $newColumns = $result2->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Cấu trúc mới:<br>";
    foreach ($newColumns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
    }
    
    echo "<h2>✅ Hoàn thành!</h2>";
    echo "<p><a href='test_nhat_ky.php'>Test lại nhật ký</a></p>";
    echo "<p><a href='index.php?action=yeu_cau'>Xem danh sách yêu cầu</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Lỗi:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>