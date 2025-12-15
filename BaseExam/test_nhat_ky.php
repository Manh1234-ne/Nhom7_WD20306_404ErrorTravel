<?php
// Test chức năng nhật ký xử lý

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test Chức năng Nhật ký xử lý</h1>";

session_start();
$_SESSION['user'] = ['ho_ten' => 'Test Admin']; // Giả lập user

try {
    require_once __DIR__ . '/models/YeuCauModel.php';
    
    $model = new YeuCauModel();
    
    echo "<h2>Test 1: Lấy nhật ký hiện tại của ID = 4</h2>";
    $logs = $model->getNhatKy(4);
    echo "Số lượng nhật ký: " . count($logs) . "<br>";
    
    if (count($logs) > 0) {
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>Thời gian</th><th>Người xử lý</th><th>Ghi chú</th><th>Trạng thái cũ</th><th>Trạng thái mới</th></tr>";
        foreach ($logs as $log) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
            echo "<td>" . htmlspecialchars($log['nguoi_xu_ly']) . "</td>";
            echo "<td>" . htmlspecialchars($log['ghi_chu']) . "</td>";
            echo "<td>" . htmlspecialchars($log['trang_thai_cu']) . "</td>";
            echo "<td>" . htmlspecialchars($log['trang_thai_moi']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<h2>Test 2: Thêm nhật ký mới</h2>";
    
    // Lấy trạng thái hiện tại
    $yeuCau = $model->find(4);
    $trangThaiCu = $yeuCau['trang_thai'];
    
    echo "Trạng thái hiện tại: " . htmlspecialchars($trangThaiCu) . "<br>";
    
    // Thêm nhật ký test
    $logData = [
        'id_yeu_cau' => 4,
        'nguoi_xu_ly' => 'Test Admin',
        'ghi_chu' => 'Test nhật ký - ' . date('Y-m-d H:i:s'),
        'trang_thai_cu' => $trangThaiCu,
        'trang_thai_moi' => 'dang_xu_ly'
    ];
    
    $result = $model->luuNhatKy($logData);
    
    if ($result) {
        echo "✓ Thêm nhật ký thành công!<br>";
        
        // Cập nhật trạng thái
        $updateResult = $model->update(4, ['trang_thai' => 'dang_xu_ly']);
        if ($updateResult) {
            echo "✓ Cập nhật trạng thái thành công!<br>";
        } else {
            echo "✗ Cập nhật trạng thái thất bại!<br>";
        }
        
        // Kiểm tra nhật ký mới
        echo "<h3>Nhật ký sau khi thêm:</h3>";
        $newLogs = $model->getNhatKy(4);
        echo "Số lượng nhật ký mới: " . count($newLogs) . "<br>";
        
        if (count($newLogs) > 0) {
            $latestLog = $newLogs[0]; // Nhật ký mới nhất
            echo "Nhật ký mới nhất:<br>";
            echo "- Thời gian: " . htmlspecialchars($latestLog['created_at']) . "<br>";
            echo "- Người xử lý: " . htmlspecialchars($latestLog['nguoi_xu_ly']) . "<br>";
            echo "- Ghi chú: " . htmlspecialchars($latestLog['ghi_chu']) . "<br>";
        }
        
    } else {
        echo "✗ Thêm nhật ký thất bại!<br>";
    }
    
    echo "<h2>✅ Test hoàn thành!</h2>";
    echo "<p><a href='index.php?action=yeu_cau_edit&id=4'>Xem trang edit</a></p>";
    echo "<p><a href='index.php?action=yeu_cau'>Quay về danh sách</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Lỗi:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
?>