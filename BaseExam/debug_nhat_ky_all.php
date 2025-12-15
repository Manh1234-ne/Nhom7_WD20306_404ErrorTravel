<?php
// Debug nhật ký cho tất cả yêu cầu

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Nhật ký - Tất cả yêu cầu</h1>";

session_start();
$_SESSION['user'] = ['ho_ten' => 'Test Admin']; // Giả lập user

try {
    require_once __DIR__ . '/models/YeuCauModel.php';
    
    $model = new YeuCauModel();
    
    echo "<h2>Danh sách tất cả yêu cầu:</h2>";
    $allRequests = $model->getAll();
    
    if (count($allRequests) > 0) {
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Tên khách</th><th>Loại</th><th>Trạng thái</th><th>Số nhật ký</th><th>Test</th></tr>";
        
        foreach ($allRequests as $req) {
            $logs = $model->getNhatKy($req['id']);
            $logCount = count($logs);
            
            echo "<tr>";
            echo "<td>" . $req['id'] . "</td>";
            echo "<td>" . htmlspecialchars($req['ten_khach']) . "</td>";
            echo "<td>" . htmlspecialchars($req['loai_yeu_cau']) . "</td>";
            echo "<td>" . htmlspecialchars($req['trang_thai']) . "</td>";
            echo "<td>" . $logCount . "</td>";
            echo "<td><a href='?test_id=" . $req['id'] . "'>Test nhật ký</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    // Test thêm nhật ký cho ID được chọn
    if (isset($_GET['test_id'])) {
        $testId = $_GET['test_id'];
        echo "<h2>Test thêm nhật ký cho ID = $testId</h2>";
        
        // Lấy thông tin yêu cầu
        $yeuCau = $model->find($testId);
        if ($yeuCau) {
            echo "Yêu cầu: " . htmlspecialchars($yeuCau['ten_khach']) . " - " . htmlspecialchars($yeuCau['loai_yeu_cau']) . "<br>";
            echo "Trạng thái hiện tại: " . htmlspecialchars($yeuCau['trang_thai']) . "<br>";
            
            // Thêm nhật ký test
            $logData = [
                'id_yeu_cau' => $testId,
                'nguoi_xu_ly' => 'Test Admin',
                'ghi_chu' => 'Test nhật ký cho ID ' . $testId . ' - ' . date('Y-m-d H:i:s'),
                'trang_thai_cu' => $yeuCau['trang_thai'],
                'trang_thai_moi' => 'dang_xu_ly'
            ];
            
            echo "<h3>Dữ liệu nhật ký sẽ thêm:</h3>";
            echo "<pre>" . print_r($logData, true) . "</pre>";
            
            try {
                $result = $model->luuNhatKy($logData);
                if ($result) {
                    echo "<p style='color: green;'>✓ Thêm nhật ký thành công!</p>";
                    
                    // Kiểm tra nhật ký mới
                    $newLogs = $model->getNhatKy($testId);
                    echo "Số nhật ký sau khi thêm: " . count($newLogs) . "<br>";
                    
                    if (count($newLogs) > 0) {
                        echo "<h4>Nhật ký mới nhất:</h4>";
                        $latest = $newLogs[0];
                        echo "- Thời gian: " . htmlspecialchars($latest['created_at']) . "<br>";
                        echo "- Người xử lý: " . htmlspecialchars($latest['nguoi_xu_ly']) . "<br>";
                        echo "- Ghi chú: " . htmlspecialchars($latest['ghi_chu']) . "<br>";
                    }
                } else {
                    echo "<p style='color: red;'>✗ Thêm nhật ký thất bại!</p>";
                }
            } catch (Exception $e) {
                echo "<p style='color: red;'>Lỗi khi thêm nhật ký: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            
        } else {
            echo "<p style='color: red;'>Không tìm thấy yêu cầu với ID = $testId</p>";
        }
    }
    
    echo "<p><a href='?'>Refresh</a></p>";
    echo "<p><a href='index.php?action=yeu_cau'>Quay về danh sách</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Lỗi:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
?>