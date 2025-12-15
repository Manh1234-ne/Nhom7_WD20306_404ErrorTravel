<?php
// Script tạo tài khoản admin đơn giản

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Tạo tài khoản Admin</h1>";

try {
    require_once __DIR__ . '/configs/database.php';
    $conn = connectDB();
    
    // Thông tin tài khoản admin
    $adminData = [
        'ho_ten' => 'Administrator',
        'ten_dang_nhap' => 'admin',
        'mat_khau' => password_hash('123456', PASSWORD_DEFAULT), // Mật khẩu: 123456
        'vai_tro' => 'admin',
        'so_dien_thoai' => '0123456789',
        'email' => 'admin@example.com'
    ];
    
    // Kiểm tra xem admin đã tồn tại chưa
    $checkAdmin = $conn->prepare("SELECT id FROM nguoi_dung WHERE ten_dang_nhap = ? OR email = ?");
    $checkAdmin->execute(['admin', 'admin@example.com']);
    
    if ($checkAdmin->rowCount() > 0) {
        echo "<p style='color: orange;'>Tài khoản admin đã tồn tại!</p>";
        $existing = $checkAdmin->fetch(PDO::FETCH_ASSOC);
        echo "<p>ID: " . $existing['id'] . "</p>";
    } else {
        // Tạo tài khoản admin mới
        $sql = "INSERT INTO nguoi_dung (ho_ten, ten_dang_nhap, mat_khau, vai_tro, so_dien_thoai, email) 
                VALUES (:ho_ten, :ten_dang_nhap, :mat_khau, :vai_tro, :so_dien_thoai, :email)";
        
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($adminData);
        
        if ($result) {
            echo "<p style='color: green;'>✓ Tạo tài khoản admin thành công!</p>";
            echo "<p>ID: " . $conn->lastInsertId() . "</p>";
        } else {
            echo "<p style='color: red;'>✗ Tạo tài khoản thất bại!</p>";
        }
    }
    
    echo "<h2>Thông tin đăng nhập:</h2>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Tên đăng nhập</th><td><strong>admin</strong></td></tr>";
    echo "<tr><th>Mật khẩu</th><td><strong>123456</strong></td></tr>";
    echo "<tr><th>Vai trò</th><td>admin</td></tr>";
    echo "</table>";
    
    echo "<h2>Tài khoản có sẵn trong hệ thống:</h2>";
    $allUsers = $conn->query("SELECT id, ho_ten, ten_dang_nhap, vai_tro, email FROM nguoi_dung ORDER BY id DESC LIMIT 10");
    $users = $allUsers->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($users) > 0) {
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Họ tên</th><th>Tên đăng nhập</th><th>Vai trò</th><th>Email</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . htmlspecialchars($user['ho_ten']) . "</td>";
            echo "<td>" . htmlspecialchars($user['ten_dang_nhap']) . "</td>";
            echo "<td>" . htmlspecialchars($user['vai_tro']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<p><a href='index.php?action=loginForm'>Đăng nhập</a></p>";
    echo "<p><a href='index.php?action=yeu_cau'>Truy cập Ghi chú đặc biệt</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Lỗi:</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>